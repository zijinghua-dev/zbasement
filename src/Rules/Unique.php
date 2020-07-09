<?php

namespace Zijinghua\Zbasement\Rules;

use Illuminate\Support\Facades\Auth;
use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class Unique
 * @package Zijinghua\Zbasement\Rules
 * 在指定的表里查找指定字段，是否存在指定的值。
 * unique是专门面向user表，允许自己的不同字段相互重复，但不允许其他用户的字段和自己的字段重复
 */
class Unique implements Rule
{
    protected $message;

    protected $request;

    protected $service;

    protected $requireDependence;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($requireDependence=['username','email','mobile','wechat_id'])
    {
        $this->service = Zsystem::service('user');
        $this->requireDependence = $requireDependence;
    }
//    public function __construct($request, $requireDependence)
//    {
//        $this->request = $request;
//
//        $this->service = Zsystem::service('user');
//
//        $this->requireDependence = $requireDependence;
//    }

    /**
     * Determine if the validation rule passes.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * unique规则仅用于api，只能用户自己创建账号，更新自己的账号
     * 管理员对账号的修改通过voyager界面，不经过web，不受这里的规则的约束
     */
    public function passes($attribute, $value)
    {
//        $this->service = Zsystem::service('user');
        $response = $this->service->multiFieldsExist($this->requireDependence, $value);
        //判断一下是否是自己，如果是自己，允许重复
        if ($response->code->status) {
            if(Auth::user()){
                //还可以验证一下是不是update方法
                $resultUuid=$response->data[0]->uuid;
                if($response==Auth::user()->uuid){
                    return true;
                }
            }
            $this->message = "用户".$value."已存在。";
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
