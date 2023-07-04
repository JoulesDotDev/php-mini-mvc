<?php

Log::Info("Auth/Register.php: executing");

if (GET) show();
else if (POST) actions();
else JSON(405, 405);

function actions()
{
    if (ACTION === "auth:register") register();
    else JSON(405, 405);
}

function show()
{
    View("Auth/Register");
}

function register()
{
    require_once "Requests/Register.php";

    try {
        $result = validate();

        if (count($result["errors"]) > 0) {
            return View("Auth/Register", $result);
        }

        $user = new UserModel();
        $user->fill($result["values"]);
        $user->save();

        redirect("/login");
    } catch (DBException $e) {
        Log::Error($e->getMessage());
        redirect("/500");
    }
}
