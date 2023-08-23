<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('auth.atm.login');
    }

    public function login(Request $request) {

        // Fingerprint Login
        if($request['Fingerprint_Image']){
            $credentials = $this->validate($request, [
                'Fingerprint_Image' => 'required|image',
            ]);

            $userImage = $request->file('Fingerprint_Image');
            $fileName = time() . '_user_fingerprint.jpg';// file name should have the atm id, for multi sessions
            $userImage->move(storage_path('app/tmp'), $fileName);

            $hash = hash_file('sha256', storage_path('app/tmp/' . $fileName));

            // Attempt to log the user in
            $user = User::where('fingerprint_hash', $hash)->first();
            if($user)
            {
                Auth::login($user);
                session()->put('Flogin', '1');
                return redirect()->intended(route('atm.account'));// The intended method redirects back to the link before the middleware redirected them to the /login, If there weren't any then goes to the route inside the intended method
            }
            // If unsuccessful, redirect back to the login with the from data
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }

        // Credit Card Login

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

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
