<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        $bSuccess = [];

        $role = array_flatten(explode('|', $role));

        $permission = array_flatten(explode('|', $permission));

        if ($request->user()->hasRole($role)) {   
            $bSuccess[] = true;
        }

        if ($permission !== null && $request->user()->hasPermission($permission)) {
            $bSuccess[] = true;
        }

        //authentication failed
        if (count($bSuccess) === 0) {
            abort(404);
        }

       return $next($request);
    }
}
