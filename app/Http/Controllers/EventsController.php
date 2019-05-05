<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Person;
use App\Models\Piece;
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
            $chambreId = $event->idRelai;
            $personUUID = $event->data->iBeacon->uuid;

            $lastEvents = $this->getLastEvents($personUUID);
            if (count($lastEvents) == 0 || count($lastEvents) == 0) {
                $nearestRoom = $chambreId;
            } else {
                if (count($lastEvents) == 1) {
                    $nearestRoom = $chambreId;
                } else {
                    $lastEvents = $this->sortEventsByDistance($lastEvents);
                    $last2Events = $this->pick2nearestRelays($lastEvents);
                    $nearestRoom = $this->identifyRoomByTrilateration($last2Events, $chambreId);
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

    private function saveEvent($event, $chambreId)
    {
        $mEvent = new Event();

        $mEvent->rssi = $event->rssi;
        $mEvent->txPower = $event->iBeacon->txPower;
        $mEvent->piece = new Piece(["id" => $event->idRelai]);
        $mEvent->actual_room = $chambreId;
        $mEvent->date_time = $event->date;

        $mEvent->save();
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
            return array_merge($this->sortEventsByDistance($left), array($pivot), $this->sortEventsByDistance($right));
        }
    }

    private function pick2nearestRelays($lastEvents)
    {
        return [
            $lastEvents[0],
            $lastEvents[1]
        ];
    }

    private function identifyRoomByTrilateration($last2Events, $chambreId)
    {
        $p1 = new Point($last2Events[0]->x, $last2Events[0]->y, $this->calculateDistance($last2Events[0]));
        $p2 = new Point($last2Events[1]->x, $last2Events[1]->y, $this->calculateDistance($last2Events[1]));
        $p3 = new Point($chambreId->x, $chambreId->y, $this->calculateDistance($last2Events[2]));
        $a = new Trilateration();

        $b = $a->Compute($p1, $p2, $p3);

        $x = $b[0];
        $y = $b[1];

        $roomId = $this->getRoomByPoint($x, $y);

        return $roomId;
    }

    private function checkAccesRight($personUUID, $nearestRoom)
    {
        $room = Piece::find($nearestRoom);
        $person = Person::where("uid_bracelet", "=", $personUUID);

        return !($room->interdite == 1 && $person->type == "PENSIONNAIRE");
    }

    private function getRoomByPoint($x, $y)
    {
        return DB::table('pieces')
            ->where([
                ['x', '<=', "$x"],
                ['x+largeur', '>=', "$x"],
                ['y', '<=', "$y"],
                ['y+longuer', '>=', "$y"],
            ])
            ->select(['id'])
            ->limit(1)
            ->get();
    }
}
