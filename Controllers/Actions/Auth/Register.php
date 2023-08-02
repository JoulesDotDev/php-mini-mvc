<?php

if (GET) show();
else if (POST) actions();

function actions()
{
    if (ACTION === "auth:register") register();
    else JSON(404, 404);
}

function show()
{
    View("Auth/Register");
}

function register()
{
    require_once "Requests/Register.php";
    require_once ROOT_DIR . "/Models/Utils/EmailVerification.php";

    try {
        $result = validate();

        if (count($result["errors"]) > 0) {
            return View("Auth/Register", $result);
        }

        $user = new User();
        $result["values"]["password"] = HashPassword($result["values"]["password"]);
        $user->fill($result["values"]);
        $user->save();
        EmailVerification::send($user);

        //return View("Auth/Register", ["success" => true]);
    } catch (DBException | EmailException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
