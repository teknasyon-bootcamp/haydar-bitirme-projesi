<?php

namespace Core\Router;

use Core\Middleware;

class Route
{
    public string $method;
    public string $path;
    public string|array $callable;
    public string $name;
    public array $middlewares;

    public function __construct($method, $path, $callable)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callable = $callable;
    }

    public function name(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function middleware(...$middlewareClasses)
    {
        foreach ($middlewareClasses as $key => $middlewareClass) {
            // is middlewareClass a object of a class or just class
            if (is_object($middlewareClass)) {
                // object
                $this->middlewares[] = $middlewareClass;
            } else {
                // class
                $this->middlewares[] = new $middlewareClass();
            }
        }

        return $this;
    }
}
