<?php

namespace App\Http\Controllers\Auth;

use App\Traits\AdminAuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AdminAuthenticatesUsers;

    protected $guard = 'admin'; // Use the 'admin' guard for this controller
    protected $model = Employee::class; // Use the Employee model for authentication

    // protected $redirectTo = RouteServiceProvider::INDEX;

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
