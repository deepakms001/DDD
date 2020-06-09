<?php

namespace Lucid\Foundation\Exceptions;

use Illuminate\Validation\Validator;

class Exception extends \Exception
{
    public function __construct(
        $message = "",
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
