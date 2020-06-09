<?php

namespace Lucid\Validation;

use Lucid\Foundation\Exceptions\InvalidInputException;

/**
 * Base Validator class, to be extended by specific validators.
 * Decorates the process of validating input. Simply declare
 * the $rules and call validate($attributes) and you have an
 * \Illuminate\Validation\Validator instance.
 */
class Validator
{
    protected $rules = [];

    protected $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * Validate the given input.
     *
     * @param array $input    The input to validate
     * @param array $rules    Specify custom rules (will override class rules)
     * @param array $messages Specify custom messages
     *
     * @return bool
     *
     * @throws InvalidInputException
     */
    public function validate($input, array $rules = [], $messages = [])
    {
        $validation = $this->validation($input, $rules, $messages);
        if ($validation->fails()) {
            $errorMessage = 'Please fill all fields properly';
            $fieldErrors = json_decode($validation->errors(),TRUE);
            throw new InvalidInputException($errorMessage, 422, null, $fieldErrors);
        }

        return true;
    }

    /**
     * Get a validation instance out of the given input and optionally rules
     * by default the $rules property will be used.
     *
     * @param array $input
     * @param array $rules
     * @param array $messages
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validation($input, array $rules = [], $messages = [])
    {
        if (empty($rules)) {
            $rules = $this->rules;
        }

        return $this->validation->make($input, $rules, $messages);
    }
}
