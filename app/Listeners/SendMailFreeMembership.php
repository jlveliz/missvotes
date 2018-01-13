<?php

namespace MissVote\Listeners;

use MissVote\Events\AccountActivated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendMailFreeMembership
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccountActivated  $event
     * @return void
     */
    public function handle(AccountActivated $event)
    {
        $client = $event->client;
        Mail::send('frontend.emails.membership-free',[],function($message) use($client) {
            $message->from(config('mail.from.address'),config('app.name'))->to($client->email , $client->name .' '. $client->last_name)->subject(trans('email.membership_free.subject'));
        });
    }
}
