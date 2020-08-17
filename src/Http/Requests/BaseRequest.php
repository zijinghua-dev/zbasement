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
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseRequest extends FormRequest implements ValidatesWhenResolved
{
    use Slug;
    public $errorCode;
    public $errorMessages=[];
    public $validateRules=[];
    protected $bread_action;
    protected function loadRules(){
        //加载slug对应的repository
        $service=Zsystem::service('validation');
        //slug转完整字段
//        $this->validateRules=$service->rules($this->slug, $this->bread_action);
        $this->validateRules=$service->rules($this->getSlug(), $this->bread_action)->data;
    }
    protected function loadMessages(){
//        $this->errorMessages=app('validationRepository')->messages($this->slug);
        $service=Zsystem::service('validation');
        //slug转完整字段
        $message=$service->messages($this->getSlug(), $this->bread_action);
        if(isset($message)){
            $this->errorMessages=$message->data;
        }
//        $this->errorMessages=$service->messages($this->slug, $this->bread_action)->data;
    }



    public function rules()
    {
        $this->setSlug(getSlug($this));
        $this->loadRules();
        if(!isset($this->validateRules)){
            return [];
        }else{
            return $this->validateRules;
        }
    }

    public function messages()
    {
        $this->loadMessages();
        if(!isset($this->errorMessages)){
            return [];
        }
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
        $this->errorCode='ZBASEMENT_CODE_'.strtoupper($this->getSlug()).'_'.strtoupper($this->bread_action).'_VALIDATION_FAILED';

        $codeMessageService=Zsystem::service('codeMessage');
//        $codeMessage=$codeMessageService->show($this->errorCode);
        $response=$codeMessageService->createMessageResponse($this->getSlug(),$this->bread_action.'_VALIDATION_FAILED');
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
//            $path=$this->path();
//            $slug = explode('/', $path)[1];
//            $slug = explode('.', $request->route()->getName())[0];
//        }

        return getSlug($this);
    }

    public function getAction(){

    }
}
