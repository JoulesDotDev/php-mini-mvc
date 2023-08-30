<?php

require_once ROOT_DIR . "/Models/User/User.php";

try {
    $user = User::getCurrentUser();
    _CONTEXT_SET("user", $user);
} catch (DBException $e) {
    redirect("/500");
}
