<?php

require_once "Load.php";
require_once ROOT_DIR . "/Models/EmailVerification.php";

try {
    EmailVerification::removeExpired();
} catch (DBException $e) {
    Log::error($e->getMessage());
}
