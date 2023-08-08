<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ATMLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'web'; // Use the 'atm' guard for this controller
    protected $model = User::class;

}

