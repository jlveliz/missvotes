<?php

namespace MissVote\Listeners;

use MissVote\Events\PredidateSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
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
       
    
        $now = Carbon::now();
        $currentMonth = Lang::get('email.casting.month_'.$now->format('m'));
        $nextMonth = Lang::get('email.casting.month_'.$now->addMonth()->format('m'));
        $minDayCurrentMonth = $now->startOfMonth()->format('d');
        $maxDayCurrentMonth = $now->endOfMonth()->format('d');
        $precandidate = $registred->precandidate;

      
        Mail::send('frontend.emails.casting',[
            'precandidate'=>$precandidate,
            'currentMonth'=>$currentMonth,
            'minDayCurrentMonth'=>$minDayCurrentMonth,
            'maxDayCurrentMonth'=>$maxDayCurrentMonth,
            'nextMonth' => $nextMonth,
        ], function($message) use ($precandidate) {
            $message->to($precandidate->email , $precandidate->name .' '. $precandidate->last_name)
                ->subject(Lang::get('email.casting.subject',['name'=>config('app.name')]));
        });
    }
}
