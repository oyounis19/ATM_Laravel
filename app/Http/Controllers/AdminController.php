<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        // $accounts = Account::all()->paginate(10); // ask chatGPT on this don't work paginate
        $accounts = Account::all(); // ask chatGPT on this don't work paginate
        $user = Auth::user();
        return view('admin.accounts', compact('user', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'username' => 'required|string|max:255',
                'password' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->route('admin.createAdmin')->withErrors($errors)->withInput();
            }

            $validatedData = $validator->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);

            Admin::create($validatedData);
            return redirect()->route('admin.createAdmin')->with('success','Admin Account created successfully!');

        }catch(QueryException $e){

            if ($e->getCode() === '23000') {
                // Redirect back with error message
                return redirect()->back()->withInput()->withErrors(['username' => 'This username is already taken.']);
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the account. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $user = Auth::user();
        return view('admin.editAccount', compact('account', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $validatedData = $request->validate([
            'type' => 'required|in:Saving,Gold,Current',
        ]);
        // // $this->authorize('update', $account); // Policy To prevent the user from updating anyone else's post

        $account->update($validatedData);

        return redirect()->route('admin.index', $account->id)->with('success', 'Account type updated updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        try {
            $account = Account::findOrFail($id);

            // $this->authorize('delete', $post); // Policy To prevent the user from updating anyone else's post

            $account->delete();

            return redirect()->route('admin.index')->with('success', 'Account deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Unauthorized');
        }
    }
}
