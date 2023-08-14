<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // use AdminAuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest:admin')->except('logout');// by using guest:admin we are allowing the users to be able to login also as admin when they are logged in as user, So they are logged in as admin and user. To prevent this use 'guest' only
    }

    public function showLoginForm(){
        return view('auth.admin.login');
    }

    public function login(Request $request){
        // Validate the form data
        $credentials = $this->validate($request, [
            'username' => 'required|max:30',
            'password' => 'required|min:6',
        ]);
        // Attempt to log the user in
        if(Auth::guard('admin')->attempt($credentials, $request->remember))
        {
            // If successful, redirect to their intended location
            // return dd(Auth::guard('admin')->user());
            return redirect()->intended(route('admin.dashboard'));// The intended method redirects back to the link before the middleware redirected them to the /login, If there weren't any then goes to the route inside the intended method
            // return redirect()->route('admin.dashboard');
        }
        // If unsuccessful, redirect back to the login with the from data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
