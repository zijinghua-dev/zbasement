<?php
namespace Zijinghua\Zbasement\Http\Services;

use App\Http\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Zijinghua\Zbasement\Exceptions\ValidationException;
use Zijinghua\Zbasement\Http\Responses\Contracts\MessageResponseInterface;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseService
{
use Slug;
    //调用fetch的位置，要将参数转换成这样的格式
    //{"search":[{"field":"wechat_id","value":"123456789","filter":"=","algothm":"or"}]}
    public function fetch($data){
        //fetch接收到的是body里的json字符串，需要转换
//        $parameters=[];
//        foreach ($data as $value){
//            if(!is_array($value)){
//                $parameters[]=json_decode($value);
//            }
//        }

        $repository=$this->repository($this->slug);
        $result=$repository->fetch($data);
        if(isset($result)){
//            $code='zbasement.code.'.$this->slug.'.fetch.success';
        $resource=$this->getResource($this->slug,'fetch');
            $messageResponse=$this->messageResponse($this->slug,'fetch.success', $result,$resource);
        }else{
            $code='zbasement.code.'.$this->slug.'.fetch.error';
//        $resource=$this->getResource($this->slug,'fetch');
            $messageResponse=$this->messageResponse($this->slug,'fetch.failed');
        }

        return $messageResponse;
    }

    public function index($data){
        $repository=$this->repository($this->slug);
        $result=$repository->index($data);
        //测试代码---------------------------------
//        $result=UserResource::collection($result);
        //测试代码结束---------------------------------
        //如果$result为null或空，那么意味着刚刚删除掉这个数据，应该报异常
        $code='zbasement.code.'.$this->slug.'.index.success';
        $resource=$this->getResource($this->slug,'index');
        $messageResponse=$this->messageResponse($this->slug,'index.success', $result,$resource);
        return $messageResponse;
    }
    //$slug,$action
//    public function messageResponse($code, $data = null, $resourceClass = null) {
//        $response=app('messageResponse');
//        $messageRepository=Zsystem::repository('codeMessage');
//        $message=$messageRepository->first('code',$code);
//        $response->set($message,$data,$resourceClass);
//        return $response;
//    }

    public function messageResponse($slug,$action, $data = null, $resourceClass = null) {
        $response=app('messageResponse');
        $messageRepository=Zsystem::repository('codeMessage');
        //拼接带slug的code，
        $code='zbasement.code';
        if(isset($slug)){
            $code=$code.'.'.$slug;
        }
        if(isset($action)){
            $code=$code.'.'.$action;
        }

        $message=$messageRepository->first('code',$code);

        if(!emptyObjectOrArray($message)){
            if(isset($action)&&(!empty($action))){
                //查找不带slug的code
                $code='zbasement.code.'.$action;
                $message=$messageRepository->first('code',$code);
            }

            if(!emptyObjectOrArray($message)){
                //报错
                $code='search.failed';

                $response=$this->messageResponse(null,$code);
                $response->appendMessages('slug='.$slug.';action='.$action.';');
                throw (new HttpResponseException($response->response()));

//                $response=$response->response();
//                throw (new HttpResponseException($response->code->httpCode, $response->response(), null, ['Content-Type'=>'application/json','Accept'=>'application/json']));
            }
        }

        $response->set($message,$data,$resourceClass);
        return $response;
    }

    //搜索到第一个就停止
    public function multiFieldsExist($fields, $value){
        foreach ($fields as $field){
            $response=$this->search($field, $value);
            if($response->code->status){
                return $response;
            }
        }
        return $response;
    }

    //查询字段是否存在，值是否存在，如果存在，返回一个列表
    public function search($field, $value) {
        $repository=$this->repository($this->slug);
        $result=$repository->fieldExist($field);
        if (!$result){
            $messageResponse=$this->messageResponse($this->slug,'INDEX_VALIDATION');
            return $messageResponse;
        }
        $result=$this->repository($this->slug)->all($field, $value);
        if (!$result->count()){
//            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_INDEX_ERROR';
            $messageResponse=$this->messageResponse($this->slug,'INDEX_FAILED');

        } else {
//            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_INDEX_SUCCESS';
            $messageResponse=$this->messageResponse($this->slug,'INDEX_SUCCESS', $result);
        }
        return $messageResponse;
    }

    public function repository($slug=null){
        //查询$slug对应的repository是否存在
        //否则返回baseRepository
        if(isset($slug)){
            return Zsystem::repository($slug);
        }
        return Zsystem::repository($this->slug);
    }

    public function store($parameters){
        //这里没有进行参数的过滤，所有参数都传给repository了
        //应该放进队列，由队列进行写入，此时状态202
        //队列完成写入后，发送消息通知用户完成写入
        $data=$this->repository($this->slug)->store($parameters);
//        $data=$this->repository($this->slug)->show($data->uuid);
//        $code='zbasement.code.'.$this->slug.'.store.submit.success';
        $resource=$this->getResource($this->slug,'store');
        $messageResponse=$this->messageResponse($this->slug,'store.submit.success',$data,$resource);
        return $messageResponse;
    }

    public function show($data){
        $repository=$this->repository($this->slug);
        $result=$repository->show($data);
        //如果$result为null或空，那么意味着刚刚删除掉这个数据，应该报异常
//        $code='zbasement.code.'.$this->slug.'.show.success';
        $resource=$this->getResource($this->slug,'show');
        $messageResponse=$this->messageResponse($this->slug,'show.success', $result,$resource);
        return $messageResponse;
    }

    public function update($parameters){
        $repository=$this->repository($this->slug);
        $result=$repository->update($parameters);
        if(isset($result)){
            $result=$repository->show(['uuid'=>$parameters['uuid']]);
        }
        //如果$result为null或空，那么意味着刚刚删除掉这个数据，应该报异常
//        $code='zbasement.code.'.$this->slug.'.show.success';
        $resource=$this->getResource($this->slug,'show');
        $messageResponse=$this->messageResponse($this->slug,'update.submit.success', $result,$resource);
        return $messageResponse;
    }

    public function getResource($slug, $bread_action=null){
        //resource类在app中注入的别名为$slug+$bread_action+resource
        return Zsystem::resource( $slug,$bread_action);
    }
}
