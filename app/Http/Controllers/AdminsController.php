<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admins\AddAdminRequest;
use App\Http\Requests\Admins\EditAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $admins = Admin::all();
        return view('administration.admins.admins')
            ->with('admins', $admins);
    }

    public function store(AddAdminRequest $request) {

        $requestData = $request->all();
        $requestData['password'] = bcrypt($request->password);

        Admin::create($requestData);

        $success = "l'admin est ajouté avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function update(EditAdminRequest $request) {

        $id = $request->id;
        $admin = Admin::find($id);
        $requestData = $request->all();
        unset($requestData['id']);

        $admin->update($requestData);

        $success = "l'admin est modifie avec success";
        return redirect()->back()->withSuccess($success);
    }

    public function delete(Request $request) {

        if(Auth::user()->id == $request->id) {

            $errors = "Vous ne pouvez pas supprimer votre compte";
            return redirect()->back()->withErrors($errors);
        }
        $admin = Admin::find($request->id);

        $admin->delete();

        $success = "l'admin est supprimer avec success";
        return redirect()->back()->withSuccess($success);
    }
}
