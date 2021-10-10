<?php

namespace App\Middlewares;

use App\Exceptions\ForbiddenException;
use Core\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle($next, $request)
    {
        if (isGuest()) {
            throw new ForbiddenException();
        }
        return $next($request);
    }
}
