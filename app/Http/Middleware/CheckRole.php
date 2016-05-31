<?php
/*
 * The core of the Roles functionality is derived from the following gist
 * https://gist.github.com/drawmyattention/8cb599ee5dc0af5f4246
 *
 */
namespace App\Http\Middleware;

use Closure;

class CheckRole
{

    public function handle($request, Closure $next)
    {
        $roles = $this->getRequiredRoleForRoute($request->route());

        if ($request->user()->hasRole($roles) || !$roles)
        {
            return $next($request);
        }

        return response(
            'You are not authorized to access this resource'
        , 404);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }

}