<?php

namespace App\Middlewares;

use Core\Middleware\MiddlewareInterface;
use Core\Request;

class VerifyRole implements MiddlewareInterface
{
    public int $permission_role_level;

    public function __construct(int $permission_role_level) 
    {
        $this->permission_role_level = $permission_role_level;
    }
    public function handle($next, Request $request)
    {
        $user = user();

        if ($user->role_level < $this->permission_role_level) {
            # code...
        }


        return $next($request);
    }
}
