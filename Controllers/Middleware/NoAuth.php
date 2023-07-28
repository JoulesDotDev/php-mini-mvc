<?php

require_once ROOT_DIR . "/Models/User.php";
require_once ROOT_DIR . "/Models/Jwt.php";

try {
    $user = User::getCurrentUser();
    if ($user) {
        _CONTEXT_SET("user", $user);
        redirect("/profile");
    }
} catch (DBException $e) {
    redirect("/500");
}
