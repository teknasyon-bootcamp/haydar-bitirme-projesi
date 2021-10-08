<?php

namespace App\Middlewares;

use Core\Middleware\MiddlewareInterface;

class RedirectIfAuthenticated implements MiddlewareInterface
{
    public function handle($next, $request)
    {
        if (!isGuest()) {
            redirect(route('manage.main'), true);
            exit;
        }

        return $next($request);
    }
}
