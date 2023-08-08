<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AtmController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // $accounts = At,::all()->paginate(10); // ask chatGPT on this don't work paginate
        $atms = Atm::all();
        $user = Auth::user();
        return view('admin.atms', compact('user', 'atms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.createAtm', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request) {
        try{
            $validatedData = $request->validate([
                'city' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'balance' => 'required|numeric'
            ]);

            // Check if ATM with the given city, area, and street already exists
                $existingAtm = Atm::where('city', $validatedData['city'])
                ->where('area', $validatedData['area'])
                ->where('street', $validatedData['street'])
                ->first();

            if ($existingAtm)
                return redirect()->route('atms.create')->with('error', 'ATM with the same location already exists.');

            Atm::create($validatedData);

            return redirect()->route('atms.index')->with('success', 'ATM created successfully');
        }catch(Exception $e){
            $errorCode = $e->getCode();
            return redirect()->route('errors.error', compact('errorCode'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $atm = Atm::findOrFail($id);
        $user = Auth::user();

        return view('admin.editAtm', compact('atm', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $atm = Atm::findOrFail($id);

        $validatedData = $request->validate([
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'area' => 'required|max:255',
            'balance' => 'required',
        ]);
        // // $this->authorize('update', $user); // Policy To prevent the user from updating anyone else's post
        // dd($validatedData);
        $atm->update($validatedData);

        return redirect()->route('atms.index')->with('success', 'ATM data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $atm = Atm::findOrFail($id);
            // $this->authorize('delete', $account);
            $atm->delete();

            return redirect()->route('atms.index')->with('success', 'ATM deleted successfully!');
        } catch (Exception $e) {
            $errorCode = $e->getCode();
            return redirect()->route('errors.error', compact('errorCode'));
        }
    }
}
