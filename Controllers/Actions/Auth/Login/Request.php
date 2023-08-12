<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Models/User/User.php";

function validate()
{
    $v = _POSTValues(["email", "password"]);

    $validator = new Validator();
    $validator->validate($v, "email")->email()->done();
    $validator->validate($v, "password")->password()->done();

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
