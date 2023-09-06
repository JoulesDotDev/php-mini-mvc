<?php

require_once ROOT_DIR . "/Controllers/Utils/Routing/Routing.php";
require_once ROOT_DIR . "/Controllers/Routes.php";

class Router
{
    private $routeMap;
    private static $routesFolder = ROOT_DIR . '/Controllers/Actions/';
    private static $middlewaresFolder = ROOT_DIR . '/Controllers/Middleware/';

    public function __construct()
    {
        $this->routeMap = Routing::getRoutes();
    }

    public function route()
    {
        $path = parse_url(URI, PHP_URL_PATH);
        $path = ltrim($path, '/');

        if ((!GET && !POST)) {
            JSON(405, 405);
            return;
        }

        if ((POST && !ACTION)) {
            JSON(404, 404);
            return;
        }

        if (key_exists($path, $this->routeMap)) {
            $controller = $this->routeMap[$path]["controller"];
            _CONTEXT_SET("_controller", $controller);
            _CONTEXT_SET("_page", $controller);
            define("HTMX", isset($_SERVER['HTTP_X_HTMX']));
            define("PATH", "/$path");

            if (is_dir(self::$routesFolder . $controller)) {
                $controller .= "/index.php";
            } else {
                $controller .= ".php";
            }

            foreach ($this->routeMap[$path]["middlewares"] as $middleware) {
                require_once self::$middlewaresFolder . $middleware . ".php";
            }
            require_once self::$routesFolder . $controller;
        } else {
            _FLASH_SET("path", "/$path");
            redirect("/404");
        }
    }
}
