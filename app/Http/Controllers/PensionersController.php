<?php

namespace App\Http\Controllers;

use App\Enums\PersonTypes;
use App\Http\Requests\Persons\AddPersonRequest;
use App\Http\Requests\Persons\EditPersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PensionersController extends Controller
{
    public function index() {

        $pensioners = Person::where('type', PersonTypes::PENSIONNAIRE)->get();
        return view('persons.pensioners.pensioners')
            ->with('pensioners', $pensioners);
    }

    public function store(AddPersonRequest $request) {

        $requestData = $request->all();
        $requestData = array_merge($requestData, ['type' => PersonTypes::PENSIONNAIRE]);

        Person::create($requestData);

        $success = "le pensionnaire est ajouter avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function update(EditPersonRequest $request) {

        $pensioner = Person::find($request->id);
        $pensioner->update($request->all());

        $success = "l'pensionnaire est modifier avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function delete(Request $request) {
        $pensioner = Person::find($request->id);
        $pensioner->delete();

        $success = "le pensionnaire est supprimer avec success";
        return redirect()->back()->withSuccess($success);
    }
}
