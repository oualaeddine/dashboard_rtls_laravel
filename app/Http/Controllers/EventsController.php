<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                    if ($lastEvents[0]->relaiId != $chambre)
                        $nearestRoom = $this->compareDistances($lastEvents[0], $event);
                    else
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
        //todo
        return [];
    }

    private function saveEvent($event, $chambre)
    {
        //todo
    }

    private function compareDistances($int, $event)
    {
        //todo
        $rssi = $event->data->rssi;

    }

    private function sortEventsByDistance($lastEvents)
    {
        //todo
    }

    private function pick2nearestRelays($lastEvents)
    {
        //todo
    }

    private function identifyRoomByTrilateration($last2Events, $event)
    {
        //todo
    }

    private function checkAccesRight($personUUID, $nearestRoom)
    {
        //todo
    }
}
