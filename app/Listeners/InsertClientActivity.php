<?php

namespace MissVote\Listeners;

use MissVote\Events\ClientActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use MissVote\Models\ClientActivity as ModelClientAcitity;

class InsertClientActivity
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
     * @param  ClientActivity  $event
     * @return void
     */
    public function handle(ClientActivity $event)
    {
        $activity = new ModelClientAcitity();
        $activity->client_id = $event->userId;
        $activity->name = $event->activity;
        $activity->params = serialize($event->params);
        $activity->save();
    }
}
