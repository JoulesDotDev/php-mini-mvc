<?php

require_once "./Config/Initialize.php";
require_once ROOT_DIR . "/Controllers/Router.php";

$router = new Router();

$url = $_SERVER['REQUEST_URI'];

$router->route($url);
