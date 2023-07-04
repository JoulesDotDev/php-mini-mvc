<?php

require_once "Validation.php";

class Validator
{
    public $errors = [];

    public function validate($values, $field_name)
    {
        return new Validation($this, $values, $field_name);
    }
}
