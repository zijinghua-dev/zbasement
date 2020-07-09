<?php


namespace Zijinghua\Zbasement\Http\Responses;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zijinghua\Zbasement\Facades\Zsystem;

class ExceptionResponse extends JsonResponse
{
    protected $request;
    protected $exception;

    public $resourceClass= 'Zijinghua\Zbasement\Http\Resources\BaseResource';
    public function __construct($data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);
    }

//    public function __construct(Request $request, \Exception $exception)
//    {
//        $this->request = $request;
//        $this->exception = $exception;
//        $this->exceptionMessage = $this->getMessage()? $this->getMessage():$this->exception->getMessage();
//        $code=is_string($this->exception->getCode())? $this->exception->getCode():null;
//        if(isset($code)){
//            $service=Zsystem::service('codeMessage');
//            $this->code=$service->show($code)->data;
//        }
//
//    }
}