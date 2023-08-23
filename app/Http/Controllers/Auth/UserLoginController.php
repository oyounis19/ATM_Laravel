<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.atm.login');
    }

    public function login(Request $request){

        if($request['Fingerprint_Image']){//Login by FP
            $credentials = $this->validate($request, [
                'Fingerprint_Image' => 'required|image',
            ]);

            $userImage = $request->file('Fingerprint_Image');
            $fileName = time() . '_user_fingerprint.jpg';
            $userImage->move(storage_path('app/tmp'), $fileName);
            // dd($userImage->getPath());
            // Attempt to log the user in
            if(User::compareFingerprintImages(storage_path('app/tmp/' . $fileName)))
            {
                // If successful, redirect to their intended location
                // return redirect()->intended(route('atm.account'));// The intended method redirects back to the link before the middleware redirected them to the /login, If there weren't any then goes to the route inside the intended method
                return 'logged in';
            }
            // If unsuccessful, redirect back to the login with the from data
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }

        // Validate the form data
        $credentials = $this->validate($request, [
            'card_id' => 'required|numeric',
            'password' => 'required|min:4|max:4',
        ]);
        // Attempt to log the user in
        if(Auth::attempt($credentials, $request->remember))
        {
            // If successful, redirect to their intended location
            return redirect()->intended(route('atm.account'));// The intended method redirects back to the link before the middleware redirected them to the /login, If there weren't any then goes to the route inside the intended method
        }
        // If unsuccessful, redirect back to the login with the from data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
