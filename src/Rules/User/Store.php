<?php

namespace Zijinghua\Zbasement\Rules\User;

use Illuminate\Http\Request;
use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;

/**
 * Class Store
 * @package Zijinghua\Zbasement\Rules
 * 用户注册，参数验证
 */
class Store implements Rule
{
    protected $message;

    /**
     * Determine if the validation rule passes.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \Exception
     */
    public function passes($attribute, $value)
    {
        $internal = getConfigValue('zbasement.fields.auth.internal');
        if (isset($value['password'])) {
            $internal = array_merge($internal, ['password']);
        }
        if (!array_diff(array_keys($value), $internal)) {
            if (!isset($value['password']) || !strlen($value['password'])) {
                $this->message = '请填写密码';
                return false;
            }
            if (isset($value['email']) == 'email') {
                if (!emailValidate($value['email'])) {
                    $this->message = '请填写正确的邮箱地址';
                    return false;
                }
            }
            if (isset($value['mobile']) == 'mobile') {
                if (!mobileValidate($value['mobile'])) {
                    $this->message = '请填写正确的手机号';
                    return false;
                }
            }
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
