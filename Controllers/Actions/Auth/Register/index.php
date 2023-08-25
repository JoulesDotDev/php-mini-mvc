<?php

_CONTEXT_SET("page", ["title" => "Register"]);

if (GET) show();
else if (POST) actions();

function actions()
{
    if (ACTION === "auth:register") register();
    else JSON(404, 404);
}

function show()
{
    View();
}

function register()
{
    require_once "Request.php";
    require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

    try {
        $result = validate();

        if (count($result["errors"]) > 0) {
            _CONTEXT_SET("result", $result);
            return View();
        }

        $user = new User();
        $result["values"]["password"] = HashPassword($result["values"]["password"]);
        $user->fill($result["values"]);
        $user->save();
        EmailVerification::send($user);

        _CONTEXT_SET("registered", true);
        _CONTEXT_SET("email", $user->email);

        return View();
    } catch (DBException | EmailException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
