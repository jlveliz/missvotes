<?php

namespace MissVote\Listeners;

use MissVote\Events\PredidateSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


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
       $mail = Mail::send('frontend.emails.casting',['precandidate'=>$registred->precandidate], function($message) use ($registred) {
            $message->to($registred->precandidate->email , $registred->precandidate->name .' '. $registred->precandidate->last_name)
                ->subject('Bienvenido a '.config('app.name').' - Datos de postulación a casting');
        });
    }
}
