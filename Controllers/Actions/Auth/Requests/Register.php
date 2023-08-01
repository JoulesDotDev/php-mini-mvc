<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Models/User.php";

function validate()
{
    $v = _POSTValues(["email", "name", "password", "verify_password"]);

    $validator = new Validator();
    $validator->validate($v, "email")
        ->required()
        ->email()
        ->maxLen(255)
        ->unique(User::table(), "email", "Email already in use")
        ->done();
    $validator->validate($v, "name")
        ->required()
        ->name()
        ->maxLen(255)
        ->done();
    $validator->validate($v, "password")
        ->required()
        ->minLen(8)
        ->maxLen(255)
        ->done();
    $validator->validate($v, "verify_password")
        ->equals($v["password"], "password")
        ->done();

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
