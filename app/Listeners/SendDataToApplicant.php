<?php

namespace MissVote\Listeners;

use MissVote\Events\ApplicantSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Mail;
use Lang;


class SendDataToApplicant
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
    public function handle(ApplicantSubscribed $registred)
    {
       
    
        $now = Carbon::now();
        $currentMonth = Lang::get('email.casting.month_'.$now->format('m'));
        $nextMonth = Lang::get('email.casting.month_'.$now->addMonth()->format('m'));
        $minDayCurrentMonth = $now->startOfMonth()->format('d');
        $maxDayCurrentMonth = $now->endOfMonth()->format('d');
        $applicant = $registred->applicant;

        Mail::send('frontend.emails.casting',[
            'applicant'=>$applicant,
            'currentMonth'=>$currentMonth,
            'minDayCurrentMonth'=>$minDayCurrentMonth,
            'maxDayCurrentMonth'=>$maxDayCurrentMonth,
            'nextMonth' => $nextMonth,
        ], function($message) use ($applicant) {
            $message->from(config('mail.from.address'),config('app.name'))->to($applicant->email , $applicant->name .' '. $applicant->last_name)
                ->subject(Lang::get('email.casting.subject',['name'=>config('app.name')]));
        });
    }
}
