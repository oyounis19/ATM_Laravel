<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AdminAuthenticatesUsers
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function redirectTo()
    {
        $user = Auth::user();
        return route('admin.dashboard',  compact('user')); // Redirect to admin dashboard after login
    }

    // You can add other customizations here as needed
}
