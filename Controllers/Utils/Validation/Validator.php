<?php

require_once "./Helpers.php";

class Validator
{
    use ValidationHelpers;

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
                if ($result !== null) {
                    $errors[] = [
                        "field_name" => $field_name,
                        "error_message" => $result
                    ];
                }
            }
        }
        return $errors;
    }
}
