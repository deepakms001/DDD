<?php

namespace Lucid\Foundation\Exceptions;

use Illuminate\Validation\Validator;

/**
 * Class ValidationFailedException
 *
 * @package Lucid\Exceptions
 * @inheritdoc
 */
class InvalidInputException extends Exception
{
    protected $fieldErrors;

    public function __construct(
        $message = "",
        $code = 0,
        Exception $previous = null,
        $fieldErrors = []
    ) {
        $this->setFieldErrors($fieldErrors);
        parent::__construct($message, $code, $previous);
    }

    public function setFieldErrors($fieldErrors)
    {
        $this->fieldErrors = $fieldErrors;
    }

    public function getFieldErrors()
    {
        return $this->fieldErrors;
    }
}
