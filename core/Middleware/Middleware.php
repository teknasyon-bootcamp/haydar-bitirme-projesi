<?php

namespace Core\Middleware;

use Closure;

class Middleware
{
    /**
     * @param stdClass $middlewareClass
     * @param Closure $next
     * @param $request
     * 
     * @return mixed
     */
    public static function call($middlewareClass, $next, $request)
    {
        call_user_func_array([new $middlewareClass, 'handle'], [$next, $request]);
    }
}