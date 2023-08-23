<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtmUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accounts(){
        $accounts = Auth::user()->account;
        switch (count($accounts)) {
            case 0:
                return view('atm.account')->with('error', 'No Accounts registered on this card');
            case 1:
                session()->put('selectedAccId', $accounts->first()->id);
                return redirect()->route('atm.menu');
            default:
                return view('atm.account', compact('accounts'));
        }
    }

    public function selectAccount($accountId){
        session()->put('selectedAccId', $accountId);
        $user = Auth::user();
        return redirect()->route('atm.menu');
    }

    public function showMenu(){
        $accountId = session('selectedAccId');
        $account = Account::findOrFail($accountId);
        $user = Auth::user();
        return view('atm.menu', compact(['account', 'user']));
    }
}
