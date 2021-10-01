<?php

namespace Core;


/**
 * This is the code that started big bang
 */
class Application
{
    public Router $router;
    public Request $request;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        // Review incoming request
        echo $this->router->resolve();
    }
}
