<?php
namespace Zijinghua\Zbasement\Http\Services;

use App\Http\Resources\UserResource;
use Zijinghua\Zbasement\Http\Responses\Contracts\MessageResponseInterface;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseService
{
use Slug;
    public function index($data){
        $repository=$this->repository($this->slug);
        $result=$repository->index($data);
        //测试代码---------------------------------
//        $result=UserResource::collection($result);
        //测试代码结束---------------------------------
        //如果$result为null或空，那么意味着刚刚删除掉这个数据，应该报异常
        $code='zbasement.code.'.$this->slug.'.index.success';
        $resource=$this->getResource($this->slug,'index');
        $messageResponse=$this->messageResponse($code, $result,$resource);
        return $messageResponse;
    }
    public function messageResponse($code, $data = null, $resourceClass = 'Zijinghua\Zbasement\Http\Resources\BaseResource') {
        $response=app('messageResponse');
        $messageRepository=Zsystem::repository('codeMessage');
        $message=$messageRepository->first('code',$code);
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

            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_INDEX_VALIDATION';
            $messageResponse=$this->messageResponse($code);
            return $messageResponse;
        }
        $result=$this->repository($this->slug)->all($field, $value);
        if (!$result->count()){
            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_INDEX_ERROR';
            $messageResponse=$this->messageResponse($code);

        } else {
            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_INDEX_SUCCESS';
            $messageResponse=$this->messageResponse($code, $result);
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
        $code='zbasement.code.'.$this->slug.'.store.submit.success';
        $resource=$this->getResource($this->slug,'store');
        $messageResponse=$this->messageResponse($code,$data,$resource);
        return $messageResponse;
    }

    public function show($uuid){
        $repository=$this->repository($this->slug);
        $result=$repository->show($uuid);
        //如果$result为null或空，那么意味着刚刚删除掉这个数据，应该报异常
        $code='zbasement.code.'.$this->slug.'.show.success';
        $resource=$this->getResource($this->slug,'show');
        $messageResponse=$this->messageResponse($code, $result,$resource);
        return $messageResponse;
    }

    public function getResource($slug, $bread_action){
        //resource类在app中注入的别名为$slug+$bread_action+resource
        return Zsystem::resource( $slug,$bread_action);//注意，这里位置颠倒了，有点不爽
    }
}