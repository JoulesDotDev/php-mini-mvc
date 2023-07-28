<?php

require_once ROOT_DIR . "/Models/User.php";

$jwt = Cookie::get("token");
$data = JWT::decode($jwt);

if (!$data) redirect("/login");

$payload = $data[1];

try {
    $user = User::getById($payload->id);
    if (!$user) redirect("/login");
    _CONTEXT_SET("user", $user);
} catch (DBException $e) {
    redirect("/500");
}
