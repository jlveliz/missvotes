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
        dd("entra");
        Validator::extend('confirmed',function($attribute, $value, $parameters, $validator){
            $client = Client::where($attribute, $value)->first();
            if ($client->confirmed == 1) return false;
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
