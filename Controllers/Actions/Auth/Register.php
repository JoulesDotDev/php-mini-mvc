<?php

require_once "./Requests/Register.php";

switch (METHOD) {
    case "GET":
        show();
    case "POST":
        actions();
}

function actions()
{
    switch (ACTION) {
        case "auth:register":
            echo register();
        default:
            http_response_code(405);
    }
}

function show()
{
    require_once ROOT_DIR . "/Views/Pages/Auth/Register.php";
}

function register()
{
    $result = validate();
    if (count($result["errors"]) > 0) {
        return json_encode($result);
    }

    return json_encode($result["values"]);
}
