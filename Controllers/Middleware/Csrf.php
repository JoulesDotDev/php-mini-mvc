<?php

if (POST && isset($_SESSION["csrf_token"])) {
    if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        JSON("CSRF", 403);
        die();
    }
} else if (!isset($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(64));
}
