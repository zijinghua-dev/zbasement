<?php

namespace Zijinghua\Zbasement\Rules;

use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class Has
 * @package Zijinghua\Zbasement\Rules
 * 单个值是否存在
 */
class JsonItem implements Rule
{
//    protected $field;
////
//    protected $request;
////
////    protected $slug;
////
//    protected $service;
//    protected $message;
//    /**
//     * Create a new rule instance.
//     *
//     * @return void
//     */
    public function __construct($field)
    {
        $this->field=$field;
    }

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
        //必须是{"search":[{"field":"wechat_id","value":"123456789","filter":"=","algorithm":"or"}]}这个结构
        if(emptyObjectOrArray($value)){
            return false;
        }
        foreach ($value as $key=>$item){
            $keys=array_keys($item);
            if(array_diff($this->field,$keys)){
                return false;
            }
        }
return true;

        //field和value必须有
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Json结构错误！';
    }
}
