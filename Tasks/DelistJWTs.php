<?php

require_once "Load.php";
require_once ROOT_DIR . "/Models/Utils/Jwt.php";

try {
    JwtModel::delistExpired();
} catch (DBException $e) {
    Log::Error($e);
}
