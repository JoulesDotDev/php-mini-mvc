<?php

_CONTEXT_SET("page", ["title" => "Reset Password"]);
if (_GET("token")) {
    _CONTEXT_SET("token", _GET("token"));
    _CONTEXT_SET("reset", true);
}

if (GET) show();
else if (POST) actions();
else JSON(405, 405);

function show()
{
    View();
}

function actions()
{
    if (ACTION === "auth:reset-request") resetRequest();
    else if (ACTION === "auth:reset-submit") resetPassword();
    else JSON(404, 404);
}

function resetRequest()
{
    require_once "ResetRequest.php";
    require_once ROOT_DIR . "/Models/User/User.php";
    require_once ROOT_DIR . "/Models/Utils/ResetPassword.php";

    $result = validate();
    if (count($result["errors"]) > 0) {
        _CONTEXT_SET("result", $result);
        return View();
    }

    $email = _POST("email");
    try {
        $user = User::getByEmail($email);
        if ($user) {
            ResetPassword::send($user);
        }
        _CONTEXT_SET("email", $email);
        _CONTEXT_SET("success", true);
        return View();
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}

function resetPassword()
{
    require_once "ChangeRequest.php";
    require_once ROOT_DIR . "/Models/User/User.php";
    require_once ROOT_DIR . "/Models/Utils/ResetPassword.php";

    $result = validate();
    if (count($result["errors"]) > 0) {
        _CONTEXT_SET("result", $result);
        return View();
    }

    try {
        $user = ResetPassword::verify(_GET("token"));
        if ($user) {
            $user->password = HashPassword(_POST("password"));
            $user->save();
            _CONTEXT_SET("success", true);
        } else {
            $result["errors"]["token"] = "Your password reset request has expired.";
            _CONTEXT_SET("result", $result);
        }
        return View();
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
