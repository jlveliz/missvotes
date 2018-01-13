<?php

namespace MissVote\Listeners;

use MissVote\Events\ClientUnsubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Lang;

class SendMailClientUnsubscribed
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
     * @param  ClientUnsubscribed  $event
     * @return void
     */
    public function handle(ClientUnsubscribed $event)
    {
        $client = $event->client;
        Mail::send('frontend.emails.unsubscribed',['client'=>$client], function($message) use($client) {
            $message->from(config('mail.from.address'),config('app.name'))->to($client->email , $client->name .' '. $client->last_name)->subject(Lang::get('email.unsubscribed.subject',['appname'=>config('app.name'),'name'=>$client->name]));
        });
    }
}
