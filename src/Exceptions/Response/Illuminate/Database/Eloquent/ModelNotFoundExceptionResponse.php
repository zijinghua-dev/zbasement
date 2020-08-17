<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2019-12-31
 * Time: 10:49
 */

namespace Zijinghua\Basement\Exceptions\Response\Illuminate\Database\Eloquent;

use Zijinghua\Basement\Exceptions\ExceptionResponse;

class ModelNotFoundExceptionResponse extends ExceptionResponse
{
    protected function getStatus()
    {
        return 404;
    }
}
