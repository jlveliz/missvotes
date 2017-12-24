<?php

namespace MissVote\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'MissVote\Listeners\UserIsLoginListener',
        ],
        'Illuminate\Auth\Events\Registered' => [
            'MissVote\Listeners\ClientRegisterListener'
        ],
        'MissVote\Events\ClientActivity' => [
            'MissVote\Listeners\InsertClientActivity'
        ],
        'MissVote\Events\ApplicantSubscribed' => [
            'MissVote\Listeners\SendDataToApplicant'
        ],
        'MissVote\Events\BuyTicket' => [
            'MissVote\Listeners\SendMailBuyTicket'
        ],
        'MissVote\Events\UpgradeMembership' => [
            'MissVote\Listeners\SendMailUpgradeMembership'
        ],
        'MissVote\Events\SendMailToPreselecteds' => [
            'MissVote\Listeners\SendMailMiss'
        ],
        'MissVote\Events\AccountActivated' => [
            'MissVote\Listeners\SendMailFreeMembership'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
