<?php

namespace Zijinghua\Basement\Exceptions\Response\Symfony\Component\HttpKernel\Exception;

use Zijinghua\Basement\Exceptions\ExceptionResponse;

class AccessDeniedHttpExceptionResponse extends ExceptionResponse
{
    protected function getStatus()
    {
        return 403;
    }
}
