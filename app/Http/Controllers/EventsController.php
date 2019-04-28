<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index() {

        return view('events.events.events');
    }

    public function specialsIndex() {

        return view('events.special_events.special_events');
    }
}
