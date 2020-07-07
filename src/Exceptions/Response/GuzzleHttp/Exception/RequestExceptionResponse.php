<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2019-12-27
 * Time: 16:25
 */

namespace Zijinghua\Basement\Exceptions\Response\GuzzleHttp\Exception;

use Zijinghua\Basement\Exceptions\ExceptionResponse;
use Symfony\Component\HttpFoundation\Response;

class RequestExceptionResponse extends ExceptionResponse
{
    protected function getStatus()
    {
        return Response::HTTP_FAILED_DEPENDENCY;
    }

    public function getMessage()
    {
        /* @var \GuzzleHttp\Exception\RequestException $exception */
        $exception = $this->exception;
        return '请求外部接口'.$exception->getRequest()->getUri().'失败, 接口返回的错误信息：'.$exception->getMessage();
    }
}
