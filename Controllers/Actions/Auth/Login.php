<?php

if (GET) show();
if (POST) actions();

function show()
{
    View("Auth/Login");
}

function actions()
{
    if (ACTION === "auth:login") login();
    else JSON(404, 404);
}

function login()
{
    require_once "Requests/Login.php";

    try {
        $result = validate();

        if (count($result["errors"]) > 0) {
            return View("Auth/Login", $result);
        }
    } catch (DBException $e) {
        Log::Error($e->getMessage());
        redirect("/500");
    }
}
