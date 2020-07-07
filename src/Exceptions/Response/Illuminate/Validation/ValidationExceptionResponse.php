<?php

namespace Zijinghua\Basement\Exceptions\Response\Illuminate\Validation;

use Zijinghua\Basement\Exceptions\ExceptionResponse;
use Symfony\Component\HttpFoundation\Response;

class ValidationExceptionResponse extends ExceptionResponse
{
    protected function getStatus()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    protected function getMessage()
    {
        $message = '';
        foreach ($this->exception->errors() as $key => $messages) {
            $key;
            $message .= implode(',', $messages).';';
        }
        return trim($message, ';');
    }
}
