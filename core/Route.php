<?php

namespace Core;

class Route
{
    public string $method;
    public string $path;
    public string|array $callable;
    public string $name;

    public function __construct($method, $path, $callable)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callable = $callable;
    }

    public function name(string $name)
    {
        $this->name = $name;
    }
}
