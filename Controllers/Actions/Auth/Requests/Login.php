<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Models/User.php";

function validate()
{
    $v = _POSTValues(["email", "password"]);

    $validator = new Validator();
    $validator->validate($v, "email")
        ->required()
        ->email()
        ->maxLen(255)
        ->done();
    $validator->validate($v, "password")
        ->required()
        ->minLen(8)
        ->maxLen(255)
        ->done();

    if (count($validator->errors) < 1) {
        User::login($v["email"], $v["password"]);
        $validator->errors["credentials"] = "Invalid email or password";
    }

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
