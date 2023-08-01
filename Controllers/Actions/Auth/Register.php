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
    require_once ROOT_DIR . "/Models/EmailVerification.php";

    try {
        $result = validate();

        if (count($result["errors"]) > 0) {
            return View("Auth/Register", $result);
        }

        $user = new User();
        $user->fill($result["values"]);
        $user->save();
        EmailVerification::send($user);

        redirect("/login");
    } catch (DBException $e) {
        Log::Error($e->getMessage());
        redirect("/500");
    } catch (EmailException $e) {
        Log::Error($e->getMessage());
        redirect("/500");
    }
}
