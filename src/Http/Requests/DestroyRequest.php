<?php


namespace Zijinghua\Zbasement\Http\Requests;


class DestroyRequest extends BaseRequest
{
    protected $bread_action='destroy';
    //要验证json参数的结构
//    public function expectsJson()
//    {
//        return true;
//    }
}