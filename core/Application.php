<?php

namespace Core;

use Core\Router\Router;

/**
 * This is the code that started big bang
 */
class Application
{
    public Router $router;
    public Request $request;
    public View $view;
    public static Application $app;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;

        session_start();
    }

    public function run()
    {
        try {
            // Review incoming request
            echo $this->router->resolve();
        } catch (\Exception $th) {

            $code = $th->getCode();
            $message = $th->getMessage();

            http_response_code($code);
            echo view('errors.commonError', ['code' => $code, 'message' => $message]);
            exit;
        }
    }
}
