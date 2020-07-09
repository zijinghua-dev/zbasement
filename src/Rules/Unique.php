<?php

namespace Zijinghua\Zbasement\Rules;

use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;

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
     */
    public function passes($attribute, $value)
    {
//        $this->service = Zsystem::service('user');
        $exists = $this->service->multiFieldsExist($this->requireDependence, $value);
        //判断一下是否是自己，如果是自己，允许重复
        if ($exists) {
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
