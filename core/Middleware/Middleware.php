<?php

namespace Core\Middleware;

use Closure;
use Core\Request;

class Middleware
{
    /**
     * @param stdClass $middlewareClass
     * @param Closure $next
     * @param $request
     * 
     * @return mixed
     */
    public static function call($middlewareClass, $next, Request $request)
    {
        call_user_func_array([new $middlewareClass, 'handle'], [$next, $request]);
    }
}