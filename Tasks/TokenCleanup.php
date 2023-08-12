<?php

require_once "Load.php";
require_once ROOT_DIR . "/Models/Utils/Jwt.php";
require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";
require_once ROOT_DIR . "/Models/Utils/ResetPassword.php";

try {
    JwtModel::delistExpired();
    EmailVerification::removeExpired();
    ResetPassword::removeExpired();
} catch (DBException $e) {
    Log::Error($e);
}
