<?php

namespace App\Middlewares;

use App\Exceptions\CSRFNotMatchException;
use Core\Middleware\MiddlewareInterface;

class CSRFTokenChecker implements MiddlewareInterface
{
    public function handle($next, $request)
    {
        if ($request->_token !== session_id()) {
            throw new CSRFNotMatchException();
        }

        return $next($request);
    }
}
