<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2019-12-27
 * Time: 17:00
 */

namespace Zijinghua\Basement\Exceptions\Response\Illuminate\Auth;

use Zijinghua\Basement\Exceptions\ExceptionResponse;

class AuthenticationExceptionResponse extends ExceptionResponse
{
    public function getStatus()
    {
        return 401;
    }
}
