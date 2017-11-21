<?php

namespace MissVote\Providers;

use Illuminate\Support\ServiceProvider;
use MissVote\Repository\ConfigRepository;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $language = ConfigRepository::getLangCurrentCasting();

        session()->put('locale',$language);

        return $this->app->setLocale($language);
        
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
