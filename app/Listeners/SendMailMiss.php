<?php

namespace MissVote\Listeners;

use MissVote\Events\SendMailToPreselecteds;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


class SendMailMiss
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
     * @param  SendMailToPreselecteds  $event
     * @return void
     */
    public function handle(SendMailToPreselecteds $event)
    {
        $misses = $event->misses;
        $request = $event->request;
        $bodyMessage = $request->body;
        $bodyOriginalMessage = $request->body;
        $subject = $request->subject;

        foreach ($misses as $key => $miss) {
            $nameMiss =  $miss->name;
            $lastNameMiss =  $miss->last_name;
            $emailMiss =  $miss->country->email_contact;
            //replace the variables $ 
            $bodyMessage = preg_replace("/!!name!!/", $nameMiss, $bodyMessage);
            $bodyMessage = preg_replace("/!!lastname!!/", $lastNameMiss, $bodyMessage);
            $bodyMessage = preg_replace("/!!email!!/", $emailMiss, $bodyMessage);

             Mail::send('frontend.emails.email-preselect',['body'=>$bodyMessage], function($message) use ($subject,$miss, $emailMiss) {
                $message->from($emailMiss,config('app.name'))->to($miss->email, $miss->name . ' '. $miss->last_name)->subject($subject);
            });
            $bodyMessage = $bodyOriginalMessage;
            $miss->mail_sended = 1;
            $miss->save();
        }
    }
}
