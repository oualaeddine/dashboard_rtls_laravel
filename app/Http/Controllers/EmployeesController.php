<?php

namespace App\Http\Controllers;

use App\Enums\PersonTypes;
use App\Http\Requests\Persons\AddPersonRequest;
use App\Http\Requests\Persons\EditPersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index() {

        $employees = Person::where('type', '!=', PersonTypes::PENSIONNAIRE)->get();

        return view('persons.employees.employees')
            ->with('employees', $employees);
    }

    public function store(AddPersonRequest $request) {

        $requestData = $request->all();
//        $requestData = array_merge($requestData, ['type' => PersonTypes::EMPLOYEE]);

        Person::create($requestData);

        $success = "l'employee est ajouter avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function update(EditPersonRequest $request) {

        $employee = Person::find($request->id);
        $employee->update($request->all());

        $success = "l'employee est modifier avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function delete(Request $request) {
        $employee = Person::find($request->id);
        $employee->delete();

        $success = "l'employee est supprimer avec success";
        return redirect()->back()->withSuccess($success);
    }
}
