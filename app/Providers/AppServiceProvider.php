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

        //CLIENT
        $this->app->bind(
            'MissVote\RepositoryInterface\ClientActivityRepositoryInterface',
            'MissVote\Repository\ClientActivityRepository'
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

         //MISSES
        $this->app->bind(
            'MissVote\RepositoryInterface\PrecandidateRepositoryInterface',
            'MissVote\Repository\PrecandidateRepository'
        );

        //VOTES TICKETS
        $this->app->bind(
            'MissVote\RepositoryInterface\TicketVoteRepositoryInterface',
            'MissVote\Repository\TicketVoteRepository'
        );

        //VOTES
        $this->app->bind(
            'MissVote\RepositoryInterface\VoteRepositoryInterface',
            'MissVote\Repository\VoteRepository'
        );

        //CLIENT APPLY
        $this->app->bind(
            'MissVote\RepositoryInterface\ClientApplyProcessRepositoryInterface',
            'MissVote\Repository\ClientApplyProcessRepository'
        );

    }
}
