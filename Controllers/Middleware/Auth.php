<?php

require_once ROOT_DIR . "/Models/User.php";
require_once ROOT_DIR . "/Models/Jwt.php";

try {
    $user = User::getCurrentUser();
    if (!$user) redirect("/login");
    _CONTEXT_SET("user", $user);
} catch (DBException $e) {
    redirect("/500");
}
