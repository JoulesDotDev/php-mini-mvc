<?php

require_once "Load.php";
require_once ROOT_DIR . "/Models/Jwt.php";

try {
    JwtModel::delistExpired();
} catch (DBException $e) {
    Log::error($e->getMessage());
}
