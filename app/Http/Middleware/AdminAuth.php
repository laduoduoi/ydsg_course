<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        //dd($request->session()->has('admin_user_id'));
        if(!$request->session()->has('admin_user_id')){
            return redirect()->route("admin.login");
        }
        return $next($request);
    }
}
