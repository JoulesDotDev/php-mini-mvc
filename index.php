<?php

define("ROOT_DIR", dirname(__FILE__));
require_once "Config/Initialize.php";
require_once ROOT_DIR . "/Controllers/Utils/Routing/Router.php";

if (PRODUCTION) {
    try {
        $router = new Router();
        $router->route();
    } catch (Exception | Error $e) {
        Log::Error($e);
        JSON("Something went terribly wrong.", 500);
    }
} else {
    $router = new Router();
    $router->route();
}
