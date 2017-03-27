<?php

namespace MissVote\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         //USERS
        $this->app->bind(
            'MissVote\RepositoryInterface\UserRepositoryInterface',
            'MissVote\Repository\UserRepository'
        );

        //CLIENT
        $this->app->bind(
            'MissVote\RepositoryInterface\MissRepositoryInterface',
            'MissVote\Repository\MissRepository'
        );

        //MEMBERSHIP
        $this->app->bind(
            'MissVote\RepositoryInterface\MembershipRepositoryInterface',
            'MissVote\Repository\MembershipRepository'
        );
        
        //MISSES
        $this->app->bind(
            'MissVote\RepositoryInterface\ClientRepositoryInterface',
            'MissVote\Repository\ClientRepository'
        );

        //VOTES TICKETS
        $this->app->bind(
            'MissVote\RepositoryInterface\TicketVoteRepositoryInterface',
            'MissVote\Repository\TicketVoteRepository'
        );

    }
}
