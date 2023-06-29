<?php

class Validator
{
    private $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function validate()
    {
        $errors = [];
        foreach ($this->rules as $field_name => $results) {
            foreach ($results as $result) {
                if ($result !== null && !isset($errors[$field_name])) {
                    $errors[$field_name] = $result;
                }
            }
        }
        return $errors;
    }
}
