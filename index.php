<?php

define('ROOT_DIR', dirname(__FILE__));
require_once "Config/Initialize.php";
require_once ROOT_DIR . "/Controllers/Router.php";

$router = new Router();
$router->route();
