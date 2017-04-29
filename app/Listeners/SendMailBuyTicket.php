<?php

namespace MissVote\Listeners;

use MissVote\Events\BuyTicket;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Lang;
use Auth;

class SendMailBuyTicket
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
     * @param  BuyTicket  $event
     * @return void
     */
    public function handle(BuyTicket $event)
    {
        Mail::send('frontend.emails.tickets',['tickets'=>$event->tickets], function($message) {
            $message->to(Auth::user()->email , Auth::user()->name .' '. Auth::user()->last_name)
                ->subject(Lang::get('email.buy_ticket.subject'));
        });
    }
}
