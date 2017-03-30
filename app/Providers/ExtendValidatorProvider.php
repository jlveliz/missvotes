<?php

namespace MissVote\Providers;

use Illuminate\Support\ServiceProvider;

use MissVote\Models\Client;

use Validator;



class ExtendValidatorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('confirmed',function($attribute, $value, $parameters, $validator){
            $clientConfirmed = Client::where($attribute, $value)->first();
            if (!$clientConfirmed->is_admin  && !$clientConfirmed->confirmed) return true;
            return false;
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
