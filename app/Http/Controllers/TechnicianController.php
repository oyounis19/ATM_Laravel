<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:tech');
    }

    public function dashboard()
    {
        $user = Auth::guard('tech')->user();
        return view('atm.account', compact('user'));
    }
}
