<?php

session_start();

if (POST && isset($_SESSION['csrf_token'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        JSON("CSRF", 403);
        die();
    }
} else {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
