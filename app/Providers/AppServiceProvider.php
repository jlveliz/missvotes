<?php

namespace MissVote\Providers;

use Illuminate\Support\ServiceProvider;
use MissVote\Repository\ConfigRepository;
use MissVote\Repository\ClientApplyProcessRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configRepo = new ConfigRepository();
        view()->share('castings', $configRepo->getAllCastings());

        $existCasting = false;
        $casting = $configRepo->find(['key'=>'exist_casting'],false);
        if (!$casting) $existCasting = config('app.castings');
        $existCasting =  $casting->payload;
        view()->share('existCasting',$existCasting);
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

        //COUNTRY
        $this->app->bind(
            'MissVote\RepositoryInterface\CountryRepositoryInterface',
            'MissVote\Repository\CountryRepository'
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
            'MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface',
            'MissVote\Repository\TicketVoteClientRepository'
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

        //COUNTRY
        $this->app->bind(
            'MissVote\RepositoryInterface\CountryRepositoryInterface',
            'MissVote\Repository\CountryRepository'
        );

        //CONFIG
        $this->app->bind(
            'MissVote\RepositoryInterface\ConfigRepositoryInterface',
            'MissVote\Repository\ConfigRepository'
        );

    }
}
