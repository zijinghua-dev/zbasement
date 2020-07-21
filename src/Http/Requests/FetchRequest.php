<?php


namespace Zijinghua\Zbasement\Http\Requests;


class FetchRequest extends IndexRequest
{
    protected $bread_action='fetch';
    //要验证json参数的结构
    public function expectsJson()
    {
        return true;
    }
}