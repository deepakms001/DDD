<?php

namespace Lucid\Authorization\Middleware;

use Lucid\Authorization\Exceptions\UnauthorizedAccess;

class RoleMiddleware
{
    public function handle($request, \Closure $next, $role, $requireAll = false)
    {
        $roles = explode('|', $role);
        if (! app('authorization')->hasRole($roles, $requireAll)) {
            throw new UnauthorizedAccess('Permission Denied', 403);
        }

        return $next($request);
    }
}