<?php

namespace MissVote\Listeners;

use MissVote\Events\PredidateSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Lang;


class SendDataToPrecandidate
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
     * @param  CandidateSubscribed  $event
     * @return void
     */
    public function handle(PredidateSubscribed $registred)
    {
       
       $precandidate = $registred->precandidate;
      
       Mail::send('frontend.emails.casting',['precandidate'=>$precandidate], function($message) use ($precandidate) {
            $message->to($precandidate->email , $precandidate->name .' '. $precandidate->last_name)
                ->subject(Lang::get('email.casting.subject',['name'=>config('app.name')]));
        });
    }
}
