<?php

namespace MissVote\Providers;

use Illuminate\Support\ServiceProvider;

use MissVote\Models\Client;

use Validator;



class ExtendValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       Validator::extend('confirmed_account',function($attribute, $value, $parameters, $validator){
            $client = Client::where($attribute, $value)->first();
            if ($client) {
                if ($client->confirmed == 1) return true;
            }
            return false;
        });

        Validator::extend('is_confirmed_account',function($attribute, $value, $parameters, $validator){
            $client = Client::where($attribute, $value)->first();
            if ($client) {
                if ($client->confirmed == 1) return false;
            }
            return true;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
