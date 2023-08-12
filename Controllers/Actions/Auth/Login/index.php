<?php

_CONTEXT_SET("page", ["title" => "Login"]);

if (GET) show();
if (POST) actions();

function show()
{
    View();
}

function actions()
{
    if (ACTION === "auth:login") login();
    else JSON(404, 404);
}

function login()
{
    require_once "Request.php";
    require_once ROOT_DIR . "/Models/User/User.php";

    try {
        $result = validate();

        if (count($result["errors"]) < 1) {
            $v = _POSTValues(["email", "password"]);
            $valid = User::login($v["email"], $v["password"]);
            if (!$valid) {
                $result["errors"]["credentials"] = "Invalid email or password";
            } else {
                $result["errors"]["unverified"] = "unverified";
            }
        }

        _CONTEXT_SET("result", $result);
        return View();
    } catch (DBException $e) {
        Log::Error($e);
        redirect("/500");
    }
}
