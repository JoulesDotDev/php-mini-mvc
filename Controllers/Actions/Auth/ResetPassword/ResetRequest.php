<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";

function validate()
{
    $v = _POSTValues(["email"]);

    $validator = new Validator();
    $validator->validate($v, "email")
        ->required()
        ->email()
        ->maxLen(255)
        ->done();

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
