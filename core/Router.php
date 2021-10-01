<?php

namespace Core;

class Router
{
    protected array $routes;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
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
            http_response_code(404);
            echo "Opps seems like someone lost their way.";
            exit;
        } elseif (is_string($callback)) {
            // Return view if callback is string
            $this->view($callback);
            exit;
        }

        // Call callback function
        return call_user_func($callback);
    }

    public function view($viewAdress, ?array $data = [])
    {
        /**
         * Serialize path
         * 
         * Ex : dashboard.pages.home => dashboard/pages/home
         */
        $viewAdress = str_replace('.', '/', $viewAdress);

        // Convert $data array to variables
        extract($data);

        // Buffer the views
        ob_start();
        include_once AppRootDirectory . "/views/$viewAdress.php";
        ob_get_flush();
    }
}
