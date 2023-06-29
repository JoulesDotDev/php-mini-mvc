<?php

if (GET) show();
else if (POST) actions();
else JSON(405, 405);

function actions()
{
    if (ACTION === "auth:register") echo register();
    else JSON(405, 405);
}

function show()
{
    LoadView("Pages/Auth/Register");
}

function register()
{
    require_once "Requests/Register.php";

    $result = validate();
    if (count($result["errors"]) > 0) {
        LoadView("Pages/Auth/Register", $result);
        return;
    }

    try {
        $user = new UserModel();
        $user->email = $result["values"]["email"];
        $user->password = HashPassword($result["values"]["password"]);
        $user->save();

        redirect("/login");
    } catch (DBException $e) {
        // TODO: Log
        redirect("/500");
    }
}
