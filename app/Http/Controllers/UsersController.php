<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewAccountMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // $accounts = Account::all()->paginate(10); // ask chatGPT on this don't work paginate
        $users = User::all(); // ask chatGPT on this don't work paginate
        $user = Auth::user();
        return view('admin.users', compact('user', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.createUser', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request) {
        try{
            $validatedData = $request->validate([
                'imageToUpload' => 'required|mimes:jpeg,png,jpg,gif',// 8 MB
                'ssn' => 'required|numeric',
                'name' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone_num' => 'required|numeric',
                'type' => 'required|string|in:saving,gold,current',
            ]);

            if(User::where('ssn', $validatedData['ssn'])->first())
                return redirect()->route('users.create')->withInput()->with('error', 'User already exists!');

            if(User::where('email', $validatedData['email'])->first())
                return redirect()->route('users.create')->withInput()->with('error', 'Email already exists!');

            if(User::where('phone_num', $validatedData['phone_num'])->first())
                return redirect()->route('users.create')->withInput()->with('error', 'Phone number already exists!');

            // Handle file upload for fingerprint
            if ($image = $request->file('imageToUpload')) {
                $fileName = $validatedData['ssn'] . '.' . $image->getClientOriginalExtension();

                // Move the image to the tmp folder
                $image->move(public_path('tmp'), $fileName);

                $hash = hash_file('sha256', public_path('tmp/' . $fileName));

                // Check if the hash exists in the database
                if(User::where('fingerprint_hash', $hash)->first()){
                    File::delete(public_path('tmp/' . $fileName));

                    return redirect()
                    ->route('users.create')
                    ->withInput()
                    ->with('error', 'Fingerprint already exists!');
                }

                // Move the image to the fingerprint_images folder
                File::move(public_path('tmp/' . $fileName), public_path('fingerprint_images/' . $fileName));

                // Save the file name and fingerprint hash to the database
                $validatedData['fingerprint'] = $fileName;
                $validatedData['fingerprint_hash'] = $hash;

                unset($validatedData['imageToUpload']);
            }
            $card = Card::generateCardInfo();// Creating Card

            $cardObj = Card::create($card);

            Account::create([ // Creating Account
                'ssn'  => $validatedData['ssn'],
                'type' => $validatedData['type'],
            ]);

            // Create the user in the database
            $validatedData['card_id'] = $card['id'];
            $validatedData['password'] = Hash::make('0000');

            $user = User::create($validatedData);

            // Sending Mail
            // Mail::to($validatedData['email'])->send(new NewAccountMail($user, $cardObj, $validatedData['type']));

            return redirect()->route('users.index')->with('success', 'The User, Account, and Card have been successfully created and linked together. An email has been sent to the user with the details of their new Card.');
        }catch(Exception $e){
            // return $e->getMessage();
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
        $curuser = User::findOrFail($id);
        $user = Auth::user();

        return view('admin.editUser', compact('curuser', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'street' => 'required|max:100',
            'area' => 'required|max:100',
            'city' => 'required|max:15',
            'email' => 'required|max:80',
            'phone_num' => 'required|max:20',
        ]);
        // // $this->authorize('update', $user); // Policy To prevent the user from updating anyone else's post
        // dd($validatedData);
        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            // $this->authorize('delete', $account);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Unauthorized');
        }
    }
}
