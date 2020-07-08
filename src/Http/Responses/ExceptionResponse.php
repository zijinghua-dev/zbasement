<?php


namespace Zijinghua\Zbasement\Http\Responses;


use Illuminate\Http\Request;
use Zijinghua\Zbasement\Facades\Zsystem;

class ExceptionResponse extends BaseMessageResponse
{
    protected $request;
    protected $exception;

    public $resourceClass='Zijinghua\Zbasement\Http\Resources\FoundationListResource';
    public function __construct(Request $request, \Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
        $this->exceptionMessage = $this->getMessage()? $this->getMessage():$this->exception->getMessage();
        $code=is_string($this->exception->getCode())? $this->exception->getCode():null;
        if(isset($code)){
            $service=Zsystem::service('codeMessage');
            $this->code=$service->show($code)->data;
        }

    }
}