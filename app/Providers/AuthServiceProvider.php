<?php

namespace MissVote\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;
use MissVote\Models\Vote;
use DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'MissVote\Model' => 'MissVote\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('acess-backend',function($user){
            if ($user->is_admin) { 
                return true; 
            }
            return false;
        });

        Gate::define('vote',function($user){
            if (!$user->is_admin && $user->confirmed) {
                return true;
            }
            return false;
        });
        //

        //allow view if can or not vote today
        Gate::define('vote_today',function($user,$miss){
            $existVote =  Vote::where('client_id',$user->id)
                            ->where('miss_id',$miss->id)
                            ->whereRaw("DATE_FORMAT(created_at,".DB::raw("'%Y-%m-%d'").") = DATE_FORMAT(".DB::raw("now()").",".DB::raw("'%Y-%m-%d'").")")
                            ->first();
            if (!$existVote) return true;
            return false;
        });
    }
}
