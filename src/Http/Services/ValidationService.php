<?php


namespace Zijinghua\Zbasement\Http\Services;


use Zijinghua\Zbasement\Http\Services\Contracts\ValidationServiceInterface;

class ValidationService extends BaseService implements ValidationServiceInterface
{
    public function rules($slug, $action){
        $repository=$this->repository();
        $rules=$repository->rules($slug, $action);
        //把格式更换为两层数组格式
        return $this->messageResponse('ZBASEMENT_CODE_'.$slug.'_'.$action.'_LOAD_RULES',$rules);

    }
    public function messages($slug, $action){
        $repository=$this->repository('validation');
        //把格式更换为两层数组格式
        $messages=$repository->messages($slug, $action);
        return $this->messageResponse('ZBASEMENT_CODE_'.$slug.'_'.$action.'_LOAD_MESSAGES',$messages);
    }
}