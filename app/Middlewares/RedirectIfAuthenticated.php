<?php

namespace App\Middlewares;

use Core\Middleware\MiddlewareInterface;
use Core\Request;

class RedirectIfAuthenticated implements MiddlewareInterface
{
    public function handle($next, Request $request)
    {
        if (!isGuest()) {
            redirect(route('manage.main'), true);
            exit;
        }
        return $next($request);
    }
}
