<?php

namespace App\Listeners;

use App\Events\AlerteEvent;
use App\Models\Alert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlerteListener
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
     * @param  AlerteEvent $event
     * @return void
     */
    public function handle(AlerteEvent $event)
    {
        $alert = new Alert();

        $alert->person_id = $event->person->id;
        $alert->piece_id = $event->roomId;

        $timestamp = time();
        $alert->date_time = date("Y-m-d H:i:s", $timestamp);

        $alert->save();
    }
}
