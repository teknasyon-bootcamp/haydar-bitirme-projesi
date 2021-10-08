<?php

namespace Core\Router;

use Core\Middleware\Middleware;
use Core\Request;
use Core\Response;

class Router
{
    public array $routes;
    protected ?Request $request;
    protected Response $response;
    public string $backUrl;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Handle get request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function get($path, $callable)
    {
        return $this->routes['get'][$path] = new Route('get', $path, $callable);
    }

    /**
     * Handle post request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function post($path, $callable)
    {
        return $this->routes['post'][$path] = new Route('post', $path, $callable);
    }

    /**
     * Handle put request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function put($path, $callable)
    {
        return $this->routes['put'][$path] = new Route('put', $path, $callable);
    }

    /**
     * Handle delete request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function delete($path, $callable)
    {
        return $this->routes['put'][$path] = new Route('put', $path, $callable);
    }

    // Resolve the request
    public function resolve()
    {
        $path = $this->request->getPath();
        $this->backUrl = $path;
        $method = $this->request->getMethod();

        // Call middlewares

        $middlewares = $this->routes[$method][$path]->middlewares ?? [];

        foreach ($middlewares as $key => $middleware) {
            $this->request = Middleware::call($middleware, function ($param) {
                return $param;
            }, $this->request);
        }

        /**
         * That means it is not required route and assing false 
         * if array is undefined
         */
        $callback = $this->routes[$method][$path]->callable ?? false;

        if ($callback === false) {
            $this->response->statusCode(404);
            echo "Opps seems like someone lost their way.";
            exit;
        } elseif (is_string($callback)) {
            // Return view if callback is string
            return view($callback);
            exit;
        } elseif (is_array($callback)) {
            /**
             * Callback is array so calling a controller. 
             * Let's assign a instance of controller to callback's first member
             */
            $callback[0] = new $callback[0];
        }

        // Call callback function
        return call_user_func($callback, $this->request);
    }
}
