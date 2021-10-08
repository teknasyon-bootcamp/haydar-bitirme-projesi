<?php

namespace Core\Middleware;

use Closure;

interface MiddlewareInterface
{
    /**
     * @param Closure $next
     * @param $request
     * 
     * @return mixed
     */
    public function handle(Closure $next, $request);
}