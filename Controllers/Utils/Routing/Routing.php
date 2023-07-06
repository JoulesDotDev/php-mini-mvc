<?php

class Routing
{
    private $routes = [];
    private $tmpRoutes = [];
    private $globalMiddleware = [];
    private static $instance = null;

    private function __construct()
    {
    }

    public static function routes($routes)
    {
        if (self::$instance == null) self::$instance = new Routing();
        self::$instance->storeRoutes($routes);
        return self::$instance;
    }

    private function storeRoutes($routes)
    {
        $this->tmpRoutes = [];
        foreach ($routes as $path => $controller) {
            $this->tmpRoutes[] = $path;

            if (!key_exists($path, $this->routes)) {
                $this->routes[$path] = [
                    "controller" => $controller,
                    "middlewares" => $this->globalMiddleware
                ];
            }
        }
    }

    public function middleware($middlewares)
    {
        if (count($this->tmpRoutes) < 1) return;
        foreach ($middlewares as $middleware) {
            $this->addmiddlewareToRoutes($middleware);
        }
        $this->tmpRoutes = [];
    }

    private function addMiddlewareToRoutes($middleware)
    {
        foreach ($this->tmpRoutes as $route => $data) {
            $middlewares = &$this->routes[$data]["middlewares"];
            if (!in_array($middleware, $middlewares)) {
                $middlewares[] = $middleware;
            }
        }
    }

    public static function globalMiddleWare($middlewares)
    {
        if (self::$instance == null) self::$instance = new Routing();
        self::$instance->globalMiddleware = $middlewares;
        return self::$instance;
    }

    public static function getRoutes()
    {
        return self::$instance->routes;
    }
}
