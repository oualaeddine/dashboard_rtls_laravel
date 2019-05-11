<?php

namespace App\Listeners;

use App\Events\SeanceStart;
use App\Models\Person;
use App\Models\Seance;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeanceStartListener
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
     * @param  SeanceStart $event
     * @return void
     */
    public function handle(SeanceStart $event)
    {
        $seance = new Seance();
        $seance->resident_id = $event->resident;
        $seance->pensionaire_id = $event->pensionnaire;
        $seance->save();
    }
}
