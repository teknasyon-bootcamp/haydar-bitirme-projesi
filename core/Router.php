<?php

namespace Core;

class Router
{
    protected array $routes;
    protected Request $request;
    protected Response $response;

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
        $this->routes['get'][$path] = $callable;
    }

    /**
     * Handle post request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function post($path, $callable)
    {
        $this->routes['post'][$path] = $callable;
    }

    /**
     * Handle put request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function put($path, $callable)
    {
        $this->routes['get'][$path] = $callable;
    }

    /**
     * Handle delete request and assign a callback
     * 
     * @param string $path
     * @param string $callable
     */
    public function delete($path, $callable)
    {
        $this->routes['delete'][$path] = $callable;
    }

    // Resolve the request
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        /**
         * That means it is not required route and assing false 
         * if array is undefined
         */
        $callback = $this->routes[$method][$path] ?? false;

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
