<?php


namespace Zijinghua\Zbasement\Http\Services;


use Symfony\Component\HttpFoundation\JsonResponse;
use Zijinghua\Zbasement\Http\Services\Contracts\CodeMessageServiceInterface;

class CodeMessageService extends BaseService implements CodeMessageServiceInterface
{
    public function createMessageResponse($slug,$action){
//        $repository=$this->repository();
//        $result=$repository->first('code', $code);
        return $this->messageResponse($slug,$action);
    }

    public function showExceptionResponse($code){
        $repository=$this->repository();
        $codeMessage=$repository->first('code', $code);
        $response=new JsonResponse(objectToArray($codeMessage), $codeMessage->httpCode);
        return $response;
    }
}