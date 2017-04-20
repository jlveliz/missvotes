<?php

namespace MissVote\Http\Middleware;

use Closure;

class LanguageMiddleware
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
        if(!session()->has('locale'))
        {
            session()->put('locale', config()->get('app.locale'));
        }

        app()->setLocale(session()->get('locale'));

        return $next($request);
    }
}
