<?php

namespace MissVote\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if ($guard == 'is_admin') {
            if (Auth::guard()->check() && Auth::user()->is_admin) {
                return redirect('backend/dashboard');
            } else {
                return redirect('backend/login');
            }
        }

        return $next($request);
    }
}
