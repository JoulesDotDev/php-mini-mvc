<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";

function validate()
{
    $v = _POSTValues(["password", "verify_password"]);

    $validator = new Validator();
    $validator->validate($v, "password")->password()->done();
    $validator->validate($v, "verify_password")
        ->equals($v["password"], "password")
        ->done();

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
