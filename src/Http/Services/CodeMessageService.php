<?php


namespace Zijinghua\Zbasement\Http\Services;


use Zijinghua\Zbasement\Http\Services\Contracts\CodeMessageServiceInterface;

class CodeMessageService extends BaseService implements CodeMessageServiceInterface
{
    public function show($code){
        $repository=$this->repository();
        $result=$repository->first('code', $code);
        return $this->messageResponse($code,$result);
    }
}