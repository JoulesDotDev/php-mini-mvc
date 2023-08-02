<?php

session_start([
    "cookie_httponly" => true,
    "cookie_secure" => PRODUCTION,
    "cookie_samesite" => "Lax",
    "cookie_httponly" => true
]);

if (POST && isset($_SESSION['csrf_token'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        JSON("CSRF", 403);
        die();
    }
} else if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
