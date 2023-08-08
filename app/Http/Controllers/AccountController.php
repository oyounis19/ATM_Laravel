<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        // $accounts = Account::all()->paginate(10); // ask chatGPT on this don't work paginate
        $accounts = Account::all(); // ask chatGPT on this don't work paginate
        $user = Auth::user();
        return view('admin.accounts', compact('user', 'accounts'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('admin.createAccount', compact('user'));
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'ssn' => 'required|numeric',
                'type' => 'required|string|max:50',
            ]);

            if ($validator->fails())
                return redirect()->route('accounts.create')->with('error', 'Form Validation Failed!');

            $validatedData = $validator->validated();

            if(!User::where('ssn', $validatedData['ssn'])->first())
                return redirect()->route('accounts.create')->with('error', 'User not found!');

            if(Account::where('ssn', $validatedData['ssn'])->where('type', $validatedData['type'])->first())
                return redirect()->route('accounts.create')->with('error', 'User already has a '.  $validatedData['type'] .' account!');


            Account::create($validatedData);
            return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
        }catch(QueryException $e){
            $errorCode = $e->getCode();
            return redirect()->route('errors.error', compact('errorCode'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $user = Auth::user();
        return view('admin.editAccount', compact('account', 'user'));
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $validatedData = $request->validate([
            'type' => 'required|in:Saving,Gold,Current',
        ]);
        // // $this->authorize('update', $account); // Policy To prevent the user from updating anyone else's post
        // dd($validatedData);
        $account->update($validatedData);

        return redirect()->route('accounts.index', $account->id)->with('success', 'Account type updated updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $account = Account::findOrFail($id);
            // $this->authorize('delete', $account);
            $account->delete();

            return redirect()->route('accounts.index')->with('success', 'Account deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('accounts.index')->with('error', 'Unauthorized');
        }
    }
}
