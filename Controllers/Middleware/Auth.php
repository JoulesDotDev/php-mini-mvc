<?php

require_once ROOT_DIR . "/Models/User.php";

$jwt = Cookie::get("token");
$payload = JWT::decode($jwt);

if (!$payload) {
    redirect("/login");
}

try {
    $user = User::getById($payload->id);
    _CONTEXT_SET("user", $user);
} catch (DBException $e) {
    redirect("/500");
}
