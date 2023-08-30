<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start([
        "cookie_httponly" => true,
        "cookie_secure" => PRODUCTION,
        "cookie_samesite" => "Lax",
        "cookie_httponly" => true
    ]);
}
