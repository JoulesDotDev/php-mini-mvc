<?php

if (GET) show();
else if (POST) actions();

function show()
{
    require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

    try {
        $token = _GET("token");
        $valid = false;
        if ($token) {
            $valid = EmailVerification::verify($token);
        }
        $data = ["valid" => $valid];
        View("Auth/VerifyEmail", $data);
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
