<?php

namespace MissVote\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check() && !Auth::user()->is_admin) {
            return redirect('/auth/login');
        } 

        return $next($request);
    }
}
