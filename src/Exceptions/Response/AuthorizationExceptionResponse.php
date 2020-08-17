<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2019-12-27
 * Time: 17:22
 */

namespace Zijinghua\Basement\Exceptions\Response;

use Zijinghua\Basement\Exceptions\ExceptionResponse;

class AuthorizationExceptionResponse extends ExceptionResponse
{
    protected function getStatus()
    {
        return 403;
    }
}
