<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index() {


        $rooms =Piece::all();
        return view('rooms')
            ->with('rooms', $rooms);
    }

    public function store(AddRoomRequest $request) {

        $requestData = $request->all();



        return redirect()->back();
    }

    public function update(EditRoomRequest $request) {


        return redirect()->back();
    }

    public function delete(Request $request) {

        return redirect()->back();
    }
}
