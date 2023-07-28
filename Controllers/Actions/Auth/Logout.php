<?php

if (POST) actions();
else JSON(405, 405);

function actions()
{
    if (ACTION === "auth:logout") logout();
    else JSON(404, 404);
}

function logout()
{
    try {
        User::logout();
    } catch (DBException $e) {
        Log::Error($e->getMessage());
        redirect("/500");
    }
}
