<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PensionersController extends Controller
{
    public function index() {

        return view('persons.pensioners.pensioners');
    }
}
