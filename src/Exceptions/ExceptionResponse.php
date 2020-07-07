<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2019-12-27
 * Time: 16:17
 */

namespace Zijinghua\Basement\Exceptions;

use Zijinghua\Basement\Http\Resources\FoundationResource;
use Zijinghua\Basement\Http\Responses\BaseMessageResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler;

class ExceptionResponse extends BaseMessageResponse
//    extends Handler
{
    protected $request;
    protected $exception;

    public $resourceClass='App\Http\Resources\FoundationListResource';
    public function __construct(Request $request, \Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
        $this->exceptionMessage = $this->getMessage()? $this->getMessage():$this->exception->getMessage();
        $this->messageBody['code']=is_string($this->exception->getCode())? $this->exception->getCode():null;
    }
}
