<?php

namespace Zijinghua\Basement\Exceptions\Response\Illuminate\DataBase;

use Zijinghua\Basement\Exceptions\ExceptionResponse;

class QueryExceptionResponse extends ExceptionResponse
{
    /**
     * 数据查询错误返回500状态码
     * @return int
     */
    protected function getStatus()
    {
        return 500;
    }
}
