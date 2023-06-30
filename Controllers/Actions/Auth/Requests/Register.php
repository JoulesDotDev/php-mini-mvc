<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Controllers/Utils/Validation/Validate.php";
require_once ROOT_DIR . "/Models/UserModel.php";

function validate()
{
    $values = [];
    $values["email"] = $email = _POST("email");
    $values["password"] = $password = _POST("password");
    $values["verify_password"] = $verify_password = _POST("verify_password");

    try {
        $validator = new Validator([
            "email" => [
                Validate::required($email),
                Validate::email($email),
                Validate::maxLen($email, 255),
                Validate::unique($email, UserModel::getTableName(), "email", "Email already in use")
            ],
            "password" => [
                Validate::required($password),
                Validate::minLen($password, 8),
                Validate::maxLen($password, 255),
            ],
            "verify_password" => [
                Validate::equals($verify_password, $password, "password"),
            ]
        ]);

        return [
            "errors" => $validator->validate(),
            "values" => $values
        ];
    } catch (PDOException  $e) { //TODO: DBException
        // TODO: Logs
        redirect("/500");
    }
}
