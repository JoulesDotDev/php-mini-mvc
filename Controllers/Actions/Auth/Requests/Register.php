<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Models/UserModel.php";

$values = [
    "email" => $_POST["email"],
    "password" => $_POST["password"],
    "verify_password" => $_POST["verify_password"],
];

$validator = new Validator([
    "email" => email(),
    "password" => password(),
    "verify_password" => verify_password()
]);

function email()
{
    global $values, $validator;
    $v = $values["email"];

    return [
        $validator->required($v),
        $validator->email($v),
        $validator->maxLen($v, 255),
        $validator->unique($v, UserModel::getTableName(), "email", "Email already in use")
    ];
}

function password()
{
    global $values, $validator;
    $v = $values["password"];

    return [
        $validator->required($v),
        $validator->minLen($v, 8),
        $validator->maxLen($v, 255),
    ];
}

function verify_password()
{
    global $values, $validator;
    $v = $values["verify_password"];

    return [
        $validator->required($v),
        $validator->equals($v, $values["password"], "password"),
    ];
}

function validate()
{
    global $values, $validator;
    return [
        "errors" => $validator->validate(),
        "values" => $values
    ];
}
