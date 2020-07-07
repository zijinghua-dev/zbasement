<?php

namespace Zijinghua\Zbasement\Http\Requests;

use Zijinghua\Zbasement\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

abstract class FormRequestWithCode extends FormRequest implements ValidatesWhenResolved
{
    public $errorCode;
    public $errorMessages=[];
    public $validateRules=[];
    abstract protected function loadRules();
    abstract protected function loadMessages();

    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->validateRules=$this->loadRules();
        $this->errorMessages=$this->loadMessages();
    }

    public function rules()
    {
        return $this->validateRules;
    }

    public function messages()
    {
        $messages=[];
        foreach ($this->errorMessages as $field => $values) {
            foreach ($values as $key => $value) {
                $messages[$field.'.'.$key]=$value;
            }
        }
        return $messages;
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, null, null, $this->errorCode))->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
    /**
     * 筛选必填依赖参数
     */
    public function getRequireColumn($currentColumn, $dependenceColumn)
    {
        if (!$currentColumn || !$dependenceColumn || !is_array($dependenceColumn)) {
            return '';
        } else {
            return implode(',', array_diff($dependenceColumn, [$currentColumn]));
        }
    }


    public function bodyParameters()
    {
        if (!isset($this->errorMessages)) {
            return [];
        }
        $newMessage=[];
        foreach ($this->errorMessages as $field => $values) {
            foreach ($values as $value) {
                if (isset($newMessage[$field]['description'])&&(!empty($newMessage[$field]['description']))) {
                    $newMessage[$field]['description']=$newMessage[$field]['description'] ."\n".$value;
                } else {
                    $newMessage[$field]['description']=$value;
                }
            }
        }
        return $newMessage;
    }
}
