<?php

namespace MissVote\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class ClientRegisterListener
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $registred)
    {
        $mail = Mail::send('frontend.emails.verify',['confirmation_code'=>$registred->user->confirmation_code], function($message) use ($registred) {
            $message->to($registred->user->email , $registred->user->name)
                ->subject('Bienvenido a Miss Panamerican - Verificación de Cuenta');
        });
    }
}
