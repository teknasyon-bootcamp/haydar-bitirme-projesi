<?php

namespace App\Middlewares;

use Core\Middleware\MiddlewareInterface;

class CSRFTokenChecker implements MiddlewareInterface
{
    public function handle($next, $request)
    {
        if ($request->_token !== session_id()) {
            http_response_code(419);
            echo view('errors.419');
            exit;
        }
        
        return $next($request);
    }
}
