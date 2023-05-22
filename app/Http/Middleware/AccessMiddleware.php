<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $access = null): Response
    {
        /*$current_args = $request->route()->parameters();
        dd($current_args);*/
        if ($access) {
            if (userCheckAccess($access)) {
                return $next($request);
            } else {
                abort(404);
            }
        }

        return $next($request);
    }
}
