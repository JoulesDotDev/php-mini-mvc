<?php

_CONTEXT_SET("page", ["title" => "Email Verification"]);

if (GET) show();
else JSON(405, 405);

function show()
{
    require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

    try {
        $token = _GET("token");
        $valid = false;
        if ($token) {
            $valid = EmailVerification::verify($token);
        }

        _CONTEXT_SET("valid", $valid);
        View();
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
