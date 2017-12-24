<?php

namespace MissVote\Listeners;

use MissVote\Events\UpgradeMembership;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Lang;
use Auth;

class SendMailUpgradeMembership
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
     * @param  UpgradeMembership  $event
     * @return void
     */
    public function handle(UpgradeMembership $event)
    {
        Mail::send('frontend.emails.membership',['membership'=>$event->membership], function($message) {
            $message->from('no-reply@misspanamint.com',config('app.name'))->to(Auth::user()->email , Auth::user()->name .' '. Auth::user()->last_name)->subject(Lang::get('email.buy_membership.subject',['name'=>config('app.name')]));
        });
    }
}
