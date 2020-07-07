<?php

namespace Zijinghua\Zbasement\Exceptions;

use Illuminate\Validation\ValidationException as BaseValidationException;

class ValidationException extends BaseValidationException
{
    public $code;

    public function __construct($validator, $response = null, $errorBag = 'default', $code = null)
    {
        parent::__construct($validator, $response, $errorBag);

        $this->code = $code;
    }
}
