<?php

_CONTEXT_SET("page", ["title" => "Email Verification"]);

if (POST) actions();
else JSON(405, 405);

function actions()
{
    if (ACTION === "auth:verify-resend") resend();
    else JSON(404, 404);
}

function resend()
{
    require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

    $email = _POST("email");

    try {
        $user = User::getByEmail($email);
        EmailVerification::send($user);

        _CONTEXT_SET("resend", true);
        View("Auth/VerifyEmail");
    } catch (DBException | EmailException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
