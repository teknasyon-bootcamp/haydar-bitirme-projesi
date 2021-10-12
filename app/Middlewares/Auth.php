<?php

namespace App\Middlewares;

use App\Exceptions\ForbiddenException;
use Core\Middleware\MiddlewareInterface;
use Core\Request;

class Auth implements MiddlewareInterface
{
    public function handle($next, Request $request)
    {
        if (isGuest()) {
            throw new ForbiddenException();
        }
        return $next($request);
    }
}
