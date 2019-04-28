<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateEmailRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $admin = Auth::user();
        return view('administration.profile.profile')
            ->with('admin', $admin);
    }

    public function updatePassword(UpdatePasswordRequest $request) {

        $admin = Auth::user();
        $password = bcrypt($request->password);
        $old_password_request = $request->old_password;
        $old_password  = $admin->password;

        if(!Hash::check($old_password_request, $old_password)) {
            $errors = 'Mot de pass incorrect';
            return redirect()->back()->withErrors($errors);
        }

        $admin->password = $password;
        $admin->updated_at = Carbon::now();
        $admin->save();

        $success = 'Mot de pass est changé avec success';
        return redirect()->back()->withSuccess($success);
    }

    public function updateEmail(UpdateEmailRequest $request) {

        $admin = Auth::user();
        $email = $request->email;
        $password = $request->password;

        if (!Hash::check($password, $admin->password)) {

            $error = 'le mot de pass incorrect';
            return redirect()->back()->withErrors($error);
        }

        $admin->email = $email;
        $admin->updated_at = Carbon::now();
        $admin->save();

        $success = 'l\'email est changé avec success';
        return redirect()->back()->withSuccess($success);
    }
}
