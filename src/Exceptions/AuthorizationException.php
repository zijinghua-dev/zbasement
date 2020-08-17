<?php

namespace Zijinghua\Basement\Exceptions;

use Illuminate\Auth\Access\AuthorizationException as BaseAuthorizationException;
use Throwable;

class AuthorizationException extends BaseAuthorizationException
{
    public function __construct(string $message = "Denied.", int $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
