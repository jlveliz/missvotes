<?php

namespace MissVote\Listeners;

use MissVote\Events\SendMailToPreselecteds;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        dd($event);
    }
}
