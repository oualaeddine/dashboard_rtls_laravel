<?php

namespace App\Http\Controllers;

use App\Enums\PieceTypes;
use App\Http\Requests\EditRoomRequest;
use App\Models\Piece;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {

        $rooms = Piece::all();
        return view('rooms.rooms')
            ->with('rooms', $rooms);
    }

    public function store(Request $request)
    {

        $requestData = $request->all();


        return redirect()->back();
    }

    public function update(EditRoomRequest $request)
    {

//        dd($request->all());
        $requestData = $request->only(['name', 'data']);

        if ($request->has('is_soins')) {
            $requestData = array_merge($requestData, ['type' => PieceTypes::SOINS]);
        } else {
            if ($request->has('is_interdite')) {
                $requestData = array_merge($requestData, ['type' => PieceTypes::INTERDITE]);
            } else {
                $requestData = array_merge($requestData, ['type' => PieceTypes::NORMAL]);
            }
        }

        $requestData = array_merge($requestData, ['isInterdite' => $request->has('is_interdite')]);


//        dd($requestData);
        $room = Piece::find($request->id);
        $room->update($requestData);

        $success = "la chambre est modifier avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function delete(Request $request)
    {

        return redirect()->back();
    }
}
