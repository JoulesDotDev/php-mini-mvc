<?php

require_once "./Routes.php";

class Router
{
    private $routeMap;
    private static $routeFile = '/Controllers/Actions/';

    public function __construct()
    {
        $this->routeMap = routes();
    }

    public function route($path)
    {
        $path = parse_url($path, PHP_URL_PATH);
        $path = ltrim($path, '/');

        if ((METHOD !== 'GET' && METHOD !== 'POST') || is_null(ACTION)) {
            http_response_code(405);
            return;
        }

        if (key_exists($path, $this->routeMap)) {
            require_once self::$routeFile . $this->routeMap[$path] . ".php";
        } else {
            require_once self::$routeFile . "Error404.php";
        }
    }
}
