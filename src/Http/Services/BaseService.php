<?php
namespace Zijinghua\Zbasement\Http\Services;

use Zijinghua\Zbasement\Http\Responses\Contracts\MessageResponseInterface;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseService
{
use Slug;
    public function messageResponse($code, $data = null, $resourceClass = 'Zijinghua\Zbasement\Http\Resources\FoundationListResource') {
        $response=app('messageResponse');
        $messageRepository=Zsystem::repository('codeMessage');
        $message=$messageRepository->first('code',$code);
        $response->set($message,$data,$resourceClass);
        return $response;
    }

    //查询字段是否存在，值是否存在，如果存在，返回一个列表
    public function search($field, $value) {
        $result=$this->repository($this->slug)->fieldExist($field);
        if (!$result){

            $code='ZBASEMENT_CODE_'.strtoupper($this->slug).'_FIELD_SEARCH_FAILED';
            $messageResponse=$this->messageResponse($code);
            return $messageResponse;
        }
        $result=$this->repository($this->slug)->all($field, $value);
        if (!$result){
            $code='VALUE_NOT_FOUND';
            $messageResponse=$this->messageResponse($code);

        } else {
            $code='VALUE_FOUND_SUCCESS';
            $messageResponse=$this->messageResponse($code, result);
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
        //应该放进队列，由队列进行写入，此时状态202
        //队列完成写入后，发送消息通知用户完成写入
        $this->repository($this->slug)->store($parameters);
        $code='zbasement.code.'.$this->slug.'.store.submit.success';
        $messageResponse=$this->messageResponse($code);
        return $messageResponse;
    }
}