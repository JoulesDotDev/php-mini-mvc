<?php

require_once ROOT_DIR . "/Models/User/User.php";
require_once ROOT_DIR . "/Models/Utils/Jwt.php";

try {
    $user = User::getCurrentUser();
    if (!$user) redirect("/login");
    _CONTEXT_SET("user", $user);
} catch (DBException $e) {
    redirect("/500");
}
