<?php

namespace Core\Middleware;

use Closure;
use Core\Request;

interface MiddlewareInterface
{
    /**
     * @param Closure $next
     * @param $request
     * 
     * @return mixed
     */
    public function handle(Closure $next, Request $request);
}