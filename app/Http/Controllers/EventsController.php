<?php /** @noinspection PhpComposerExtensionStubsInspection */

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Piece;
use App\Models\Point;
use App\Models\Seance;
use App\Models\Trilateration;
use DateInterval;
use DateTime;


class EventsController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();
        $seances = Seance::all();
        return view('events.events.events')
            ->with('alerts', $alerts)
            ->with('seances', $seances);
    }

    public function specialsIndex()
    {
        return view('events.special_events.special_events');
    }


    public function onNewEvent($event, $callback)
    {

        if ($event->idRelai != null && $event->data != null) {
            $chambreId = $event->idRelai;
            $personUUID = $event->data->iBeacon->uuid;
            $lastEvents = [];
            if (array_key_exists($personUUID, EventsController::$last_events))
                $lastEvents = $this->getLastEvents($event);

            if (count($lastEvents) == 0 || count($lastEvents) == 0) {
                $nearestRoom = $chambreId;
            } else {
                if (count($lastEvents) == 1) {
                    $d1 = $this->calculateDistance($lastEvents[0]);
                    $d2 = $this->calculateDistance($event);

                    if ($d1 > $d2)
                        $nearestRoom = $chambreId;
                    else
                        $nearestRoom = $lastEvents[0]->idRelai;

                } else {
                    $lastEvents = $this->sortEventsByDistance($lastEvents);
                    $last2Events = $this->pick2nearestRelays($lastEvents);
                    $nearestRoom = $this->identifyRoomByTrilateration($last2Events, $event);
                }
            }


            $callback($personUUID, $nearestRoom);
            $hasAccess = $this->checkAccesRight($personUUID, $nearestRoom);
            if (!$hasAccess) {
                $this->declancherAlerte($personUUID);
            }
            $this->saveEvent($event, $nearestRoom);

        }
    }

    private static $last_events = [];
    private static $person_last_index = [];

    private function getLastEvents($event)
    {
        $personUUID = $event->data->iBeacon->uuid;
        $result_events = $this->getLast5secondsEvents(EventsController::$last_events[$personUUID], $event);
        $mEvents = [];
        for ($i = 0; $i < count($result_events); $i++) {
            if ($result_events[$i]->idRelai != $event->idRelai) {
                $mEvents[] = $result_events[$i];
            }
        }
        return $mEvents;
    }

    private function getLast5secondsEvents($events, $mEvent)
    {
        $rId = $mEvent->idRelai;
        $result = [];
        try {
            foreach ($events as $event) {
                $mTime = new DateTime($event->date);
                $mt = $mTime->getTimestamp() - 700;
                $mTime = $mTime->getTimestamp();
                if ($event->idRelai != $rId)
                    if (!$this->resultContains($result, $event))
                        if ($mt < $mTime)
                            $result[] = $event;
            }
        } catch (\Exception $e) {
            echo $e;
        }
        return $result;
    }

    private function saveEvent($event, $nearestRoom)
    {

        $personUUID = $event->data->iBeacon->uuid;

        if (!array_key_exists($personUUID, EventsController::$person_last_index)) {
            EventsController::$person_last_index[$personUUID] = 0;
        }

        $last_index = EventsController::$person_last_index[$personUUID];

        if ($last_index + 1 > 10)
            $last_index = -1;
        EventsController::$person_last_index[$personUUID] = $last_index + 1;

        $event->actualRoom = $nearestRoom;
        EventsController::$last_events[$personUUID][$last_index] = $event;
    }

    private function calculateDistance($event)
    {
        $N = 2;

        $a = ((float)$event->data->iBeacon->txPower);
        $b = ((float)$event->data->rssi);

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
        $result = [];
        $result[] = $lastEvents[0];
        foreach ($lastEvents as $lastEvent) {
            if ($lastEvent->idRelai != $result[0]->idRelai) {
                $result[] = $lastEvent;
                return $result;
            }
        }
        return $result;
    }

    private function identifyRoomByTrilateration($last2Events, $event)
    {
        $room1 = Piece::find($last2Events[0]->idRelai);
        $room2 = Piece::find($last2Events[1]->idRelai);

        $room3 = Piece::find($event->idRelai);

        $x1 = json_decode($room1->data)->x;
        $x2 = json_decode($room2->data)->x;
        $x3 = json_decode($room3->data)->x;

        $y1 = json_decode($room1->data)->y;
        $y2 = json_decode($room2->data)->y;
        $y3 = json_decode($room3->data)->y;

        $p1 = new Point($x1, $y1, $this->calculateDistance($last2Events[0]));
        $p2 = new Point($x2, $y2, $this->calculateDistance($last2Events[1]));
        $p3 = new Point($x3, $y3, $this->calculateDistance($event));

        $b = $this->computeTrilateration($p1, $p2, $p3);

        $x = $b[0];
        $y = $b[1];

        $roomId = $this->getRoomByPoint($x, $y);

        return $roomId;
    }

    function computeTrilateration(Point $p1, Point $p2, Point $p3)
    {
        echo json_encode($p1) . "\n";
        echo json_encode($p2) . "\n";
        echo json_encode($p3) . "\n";

        $xa = $p1->getX();
        $ya = $p1->getY();
        $xb = $p2->getX();
        $yb = $p2->getY();
        $xc = $p3->getX();
        $yc = $p3->getY();
        $ra = $p1->getD();
        $rb = $p2->getD();
        $rc = $p3->getD();

        $S = (pow($xc, 2.) - pow($xb, 2.) + pow($yc, 2.) - pow($yb, 2.) + pow($rb, 2.) - pow($rc, 2.)) / 2.0;
        $T = (pow($xa, 2.) - pow($xb, 2.) + pow($ya, 2.) - pow($yb, 2.) + pow($rb, 2.) - pow($ra, 2.)) / 2.0;


        $okokok = ((($ya - $yb) * ($xb - $xc)) - (($yc - $yb) * ($xb - $xa)));
        $y = (($T * ($xb - $xc)) - ($S * ($xb - $xa))) / $okokok;


        $x = (($y * ($ya - $yb)) - $T) / ($xb - $xa);

        return [$x, $y];
    }

    private function checkAccesRight($personUUID, $nearestRoom)
    {
        /*  $room = Piece::find($nearestRoom);
          $person = Person::where("uid_bracelet", "=", $personUUID);*/

        return true /*!($room->isInterdite == 1 && $person->type == "PENSIONNAIRE")*/
            ;
    }

    private function getRoomByPoint($x, $y)
    {
        $rooms = Piece::all();

        foreach ($rooms as $room) {
            if ($this->isInRoom($room, $x, $y)) {
                return $room;
            }
        }
        return 0;
    }

    private function isInRoom($room, $x, $y)
    {
        $room_data = json_decode($room->data);
        $room_corners = $room_data->corners;

        $polyCorners = count($room_corners);
        $polyX = [];
        $polyY = [];

        for ($i = 0; $i < $polyCorners; $i++) {
            $polyX[$i] = $room_corners[$i]->x;
            $polyY[$i] = $room_corners[$i]->y;
        }

        $j = $polyCorners - 1;
        $multiple = [];
        $constant = [];
        for ($i = 0; $i < $polyCorners; $i++) {
            if ($polyY[$j] == $polyY[$i]) {
                $constant[$i] = $polyX[$i];
                $multiple[$i] = 0;
            } else {
                $constant[$i] = $polyX[$i] - ($polyY[$i] * $polyX[$j]) / ($polyY[$j] - $polyY[$i]) + ($polyY[$i] * $polyX[$i]) / ($polyY[$j] - $polyY[$i]);
                $multiple[$i] = ($polyX[$j] - $polyX[$i]) / ($polyY[$j] - $polyY[$i]);
            }
            $j = $i;
        }

        $oddNodes = false;
        $current = $polyY[$polyCorners - 1] > $y;
        $previous = null;
        for ($i = 0; $i < $polyCorners; $i++) {
            $previous = $current;
            $current = $polyY[$i] > $y;
            if ($current != $previous) $oddNodes ^= $y * $multiple[$i] + $constant[$i] < $x;
        }
        return $oddNodes;
    }

    private function declancherAlerte($personUUID)
    {
        //todo declancher evenement alerte
    }

    private function publishPosition($personUUID, $nearestRoom)
    {


    }

    private function resultContains(array $result, $event)
    {
        foreach ($result as $res) {
            if ($res->idRelai == $event->idRelai) return true;
        }
        return false;
    }
}
