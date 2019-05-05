<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Point;
use Trilateration;

class EventsController extends Controller
{
    public function index()
    {

        return view('events.events.events');
    }

    public function specialsIndex()
    {

        return view('events.special_events.special_events');
    }


    public function onNewEvent($event)
    {
        if ($event->idRelai != null && $event->data != null) {
            $chambre = $event->idRelai;
            $personUUID = $event->data->iBeacon->uuid;

            $lastEvents = $this->getLastEvents($personUUID);
            if (count($lastEvents) == 0 || count($lastEvents) == 0) {
                $nearestRoom = $chambre;
            } else {
                if (count($lastEvents) == 1) {
                    $nearestRoom = $chambre;
                } else {
                    $lastEvents = $this->sortEventsByDistance($lastEvents);
                    $last2Events = $this->pick2nearestRelays($lastEvents);
                    $nearestRoom = $this->identifyRoomByTrilateration($last2Events, $event);
                }
            }

            $this->saveEvent($event, $nearestRoom);
            $this->checkAccesRight($personUUID, $nearestRoom);
        }
    }

    private function getLastEvents($uuid)
    {
        return DB::table('events')
            ->join('persons', 'person.id', '=', 'events.person_id')
            ->where([
                ['persons.uid_bracelet', '=', "$uuid"],
                ['events.date_time', '<', 'date_sub(now(), interval 6 second)'],
            ])
            ->get();
    }

    private function saveEvent($event, $chambre)
    {
        //todo
    }

    private function calculateDistance($event)
    {
        $N = 2;

        $a = ((float)$event->iBeacon->txPower);
        $b = ((float)$event->rssi);

        $c = $a - $b;

        $xtr = ($c / (10 * $N));

        return pow(10, $xtr);
    }

    private function sortEventsByDistance($lastEvents)
    {
        $length = count($lastEvents);
        if ($length <= 1) {
            return $lastEvents;
        } else {
            $pivot = $lastEvents[0];
            $left = $right = array();
            for ($i = 1; $i < count($lastEvents); $i++) {
                if ($this->calculateDistance($lastEvents[$i]) < $this->calculateDistance($pivot)) {
                    $left[] = $lastEvents[$i];
                } else {
                    $right[] = $lastEvents[$i];
                }
            }
            return array_merge(quick_sort($left), array($pivot), quick_sort($right));
        }
    }

    private function pick2nearestRelays($lastEvents)
    {
        return [
            $lastEvents[0],
            $lastEvents[1]
        ];
    }

    private function identifyRoomByTrilateration($last2Events, $event)
    {
        $p1 = new Point($last2Events[0]->x, $last2Events[0]->y, $this->calculateDistance($last2Events[0], $event));
        $p2 = new Point($last2Events[1]->x, $last2Events[1]->y, $this->calculateDistance($last2Events[1], $event));
        $p3 = new Point($last2Events[2]->x, $last2Events[2]->y, $this->calculateDistance($last2Events[2], $event));
        $a = new Trilateration();

        $b = $a->Compute($p1, $p2, $p3);

        $x = $b[0];
        $y = $b[1];

        $roomId = $this->getRoomByPoint($x, $y);

        return $roomId;
    }

    private function checkAccesRight($personUUID, $nearestRoom)
    {
        //todo
    }

    private function getRoomByPoint($x, $y)
    {
        //todo
    }
}
