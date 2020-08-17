<?php
namespace App\Http\Resources\Traits;

/**
 * Trait SetResource
 * @package App\Http\Resources\Traits
 * 资源的使用者需要调用set方法，把code message传入资源
 * 如果code message的数据源修改了结构，需要在这里同步修改$messageBody
 */
trait SetResource
{
    protected $messageBody=[
        'code'=>null,
        'status'=>null,
        'message'=>null,
    ];
    public function set($messageBody)
    {
        foreach (array_keys($this->messageBody) as $key) {
            if (isset($messageBody[$key])) {
                $this->messageBody[$key]=$messageBody[$key];
            }
        }
    }
}
