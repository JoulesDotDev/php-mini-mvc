<?php

_CONTEXT_SET("page", ["title" => "Logout"]);

if (POST) actions();
else JSON(405, 405);

function actions()
{
    if (ACTION === "auth:logout") logout();
    else JSON(404, 404);
}

function logout()
{
    require_once ROOT_DIR . "/Models/User/User.php";

    try {
        User::logout();
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
