<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:tech')->except('logout');// by using guest:tech we are allowing the users to be able to login also as admin when they are logged in as user, So they are logged in as admin and user. To prevent this use 'guest' only
    }

    public function login(Request $request){
        // Validate the form data
        $credentials = $this->validate($request, [
            'username' => 'required|max:30',
            'password' => 'required|min:6',
        ]);
        // Attempt to log the user in
        if(Auth::guard('tech')->attempt($credentials, $request->remember))
        {
            // If successful, redirect to their intended location
            return redirect()->intended(route('atm.dashboard'));// The intended method redirects back to the link before the middleware redirected them to the /login, If there weren't any then goes to the route inside the intended method
        }
        // If unsuccessful, redirect back to the login with the from data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }
    public function logout(){
        Auth::guard('tech')->logout();
        return redirect('/');
    }
}
