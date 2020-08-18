<?php

namespace Zijinghua\Zbasement\Rules\User;

use Illuminate\Http\Request;
use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;

/**
 * Class Update
 * @package Zijinghua\Zbasement\Rules
 * 用户编辑，参数验证
 */
class Update implements Rule
{
    protected $message;
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

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
        if (emptyObjectOrArray($value)) {
            return false;
        }
        if (array_diff($this->field, array_keys($value))) {
            $this->message = '缺少参数' . implode(',', $this->field);
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
