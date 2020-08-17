<?php


namespace Zijinghua\Zbasement\Http\Requests;


class DeleteRequest extends BaseRequest
{
    protected $bread_action='delete';
    //要验证json参数的结构
    public function expectsJson()
    {
        return true;
    }
}