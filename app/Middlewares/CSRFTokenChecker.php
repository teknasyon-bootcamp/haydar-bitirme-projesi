<?php

namespace App\Middlewares;

use App\Exceptions\CSRFNotMatchException;
use Core\Middleware\MiddlewareInterface;
use Core\Request;

class CSRFTokenChecker implements MiddlewareInterface
{
    public function handle($next, Request $request)
    {
        if ($request->_token !== session_id()) {
            throw new CSRFNotMatchException();
        }

        return $next($request);
    }
}
