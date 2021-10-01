<?php

namespace Core;


/**
 * This is the code that started big bang
 */
class Application
{
    public Router $router;
    public Request $request;
    public Application $app;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;
    }

    public function run()
    {
        // Review incoming request
        echo $this->router->resolve();
    }
}
