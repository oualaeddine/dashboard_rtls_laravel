<?php

namespace App\Listeners;

use App\Events\EndSeanceEvent;
use App\Models\Seance;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class EndSeanceEventListener
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
     * @param  EndSeanceEvent $event
     * @return void
     */
    public function handle(EndSeanceEvent $event)
    {
        $id = $event->personId;
        $timestamp = time();

        $seances = DB::table('seances')
            ->where('end_date', null)
            ->where(function ($q) use ($id) {
                return $q->where('pensionaire_id', $id)
                    ->orWhere('resident_id', null);
            })
            ->get();

        foreach ($seances as $seance) {
            $seance->end_date = date("Y-m-d H:i:s", $timestamp);
          //  $seance->save();
        }

    }
}
