<?php

namespace Zijinghua\Zbasement\Http\Requests;

use Symfony\Component\HttpFoundation\JsonResponse;
use Zijinghua\Zbasement\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Responses\BaseMessageResponse;
use Zijinghua\Zbasement\Http\Responses\ExceptionResponse;
use Zijinghua\Zbasement\Http\Responses\ValidationExceptionResponse;

class FormRequestWithCode extends FormRequest implements ValidatesWhenResolved
{
    protected $slug;
    public $errorCode;
    public $errorMessages=[];
    public $validateRules=[];
    protected $bread_action;
    protected function loadRules(){
        //加载slug对应的repository
        $service=Zsystem::service('validation');
        //slug转完整字段
//        $this->validateRules=$service->rules($this->slug, $this->bread_action);
        $this->validateRules=$service->rules($this->slug, $this->bread_action)->data;
    }
    protected function loadMessages(){
//        $this->errorMessages=app('validationRepository')->messages($this->slug);
        $service=Zsystem::service('validation');
        //slug转完整字段
        $this->errorMessages=$service->messages($this->slug, $this->bread_action)->data;
    }

//    public function __construct(
//        array $query = [],
//        array $request = [],
//        array $attributes = [],
//        array $cookies = [],
//        array $files = [],
//        array $server = [],
//        $content = null
//    ) {
//        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
//
//    }

    public function rules()
    {
        $this->slug=$this->getSlug();
        $this->loadRules();

        return $this->validateRules;
    }

    public function messages()
    {
        $this->loadMessages();
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
        $this->errorCode='ZBASEMENT_CODE_'.strtoupper($this->slug).'_'.strtoupper($this->bread_action).'_VALIDATION';

        $codeMessageService=Zsystem::service('codeMessage');
//        $codeMessage=$codeMessageService->show($this->errorCode);
        $response=$codeMessageService->show($this->errorCode);
        $response->appendMessages($validator->errors()->all());
        $response=$response->response();
//        $response->set($codeMessage, null, 'Zijinghua\Zbasement\Http\Resources\BaseResource');
        throw (new ValidationException($validator, $response, null, $this->errorCode))->errorBag($this->errorBag)
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

    public function getSlug()
    {
//        if (isset($this->slug)) {
//            $slug = $this->slug;
//        } else {
            $path=$this->path();
            $slug = explode('/', $path)[2];
//            $slug = explode('.', $request->route()->getName())[0];
//        }

        return $slug;
    }

    public function getAction(){
        
    }
}
