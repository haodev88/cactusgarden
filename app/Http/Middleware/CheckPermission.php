<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;



class CheckPermission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->id != 2) {
            $route = $request->route() ? $request->route()->getName() : '';
            $user  = Auth::user()->hasRole($route);
            if (!$user) {
                return redirect()->route('403-error');
            }
        }
        return $next($request);
    }
 

}
