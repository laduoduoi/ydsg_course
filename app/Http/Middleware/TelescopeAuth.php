<?php

namespace App\Http\Middleware;

use Closure;

class TelescopeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('production') && !in_array($request->header('x-forwarded-for'), explode(',', env('TELESCOPE_WHITELIST')))){
            abort(403, $request->header('x-forwarded-for'));
        }

        return $next($request);
    }
}
