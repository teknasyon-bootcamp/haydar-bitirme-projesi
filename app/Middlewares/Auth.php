<?php

namespace App\Middlewares;

use Core\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle($next, $request)
    {
        if (isGuest()) {
            http_response_code(403);
            echo view('errors.403');
            exit;
        }
        return $next($request);
    }
}
