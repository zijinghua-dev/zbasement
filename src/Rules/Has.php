<?php

namespace Zijinghua\Zbasement\Rules;

use Zijinghua\Zbasement\Facades\Zsystem;
use Illuminate\Contracts\Validation\Rule;

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
    public function __construct($request, $requireDependence)
    {
        $this->request = $request;
        $this->field=$requireDependence['field'];
        $this->slug=$requireDependence['slug'];
        $this->service=Zsystem::service($this->slug);
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
        $response=$this->service->search($attribute, $value);
        if (!$response->code->status) {
            $this->message = '字段'.$attribute.',值'. $value.'.'.config('zbasement.validation.message.field.has.value');
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
