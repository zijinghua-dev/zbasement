<?php

namespace Zijinghua\Zbasement\Rules;

use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class Has
 * @package Zijinghua\Zbasement\Rules
 * 单个值是否存在
 */
class Has implements Rule
{
    protected $field;
//
    protected $request;
//
    protected $slug;
//
    protected $service;
    protected $message;
//    /**
//     * Create a new rule instance.
//     *
//     * @return void
//     */
//    public function __construct($field)
//    {
//        $this->field=$field;
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
        $slug=getSlug(request());
        $service=Zsystem::service($slug);
        //拼接查询参数
        $parameters['search'][]=['field'=>$attribute,'value'=>$value];
        $response=$service->fetch($parameters);
        if (!$response->code->status) {
            $this->message = '字段'.$attribute.'的值'. $value.'无法找到';
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
