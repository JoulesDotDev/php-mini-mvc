<?php

require_once "Routes.php";

class Router
{
    private $routeMap;
    private static $routesFolder = ROOT_DIR . '/Controllers/Actions/';

    public function __construct()
    {
        $this->routeMap = routes();
    }

    public function route()
    {
        $path = parse_url(URI, PHP_URL_PATH);
        $path = ltrim($path, '/');

        if ((!GET && !POST) || (POST && !ACTION)) {
            JSON(405, 405);
            return;
        }

        if (key_exists($path, $this->routeMap)) {
            require_once self::$routesFolder . $this->routeMap[$path] . ".php";
        } else {
            require_once self::$routesFolder . "Error/404.php";
        }
    }
}
