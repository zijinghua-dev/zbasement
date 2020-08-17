<?php


namespace Zijinghua\Zbasement\Http\Requests;


class ClearRequest extends BaseRequest
{
    protected $bread_action='clear';
    //要验证json参数的结构
//    public function expectsJson()
//    {
//        return true;
//    }
}