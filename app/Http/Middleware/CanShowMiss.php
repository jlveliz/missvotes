<?php

namespace MissVote\Http\Middleware;

use MissVote\Repository\ConfigRepository;
use Closure;
use Auth;


class CanShowMiss
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
        $configRepo = new ConfigRepository();
        $existCasting = false;
        $casting = $configRepo->find(['key'=>'exist_casting'],false);
        if (!$casting) $existCasting = config('app.castings');
        $existCasting =  $casting->payload;
       


        if ($existCasting) {
            return redirect('/account/');
        } else {
            return $next($request);
        }

        // return redirect('/auth/login');

    }
}
