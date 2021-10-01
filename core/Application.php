<?php

namespace Core;


/**
 * This is the code that started big bang
 */
class Application
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        // Review incoming request
        echo $this->router->resolve();
    }
}
