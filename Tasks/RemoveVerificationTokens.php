<?php

require_once "Load.php";
require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

try {
    EmailVerification::removeExpired();
} catch (DBException $e) {
    Log::Error($e);
}
