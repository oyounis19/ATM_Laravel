<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'ssn' => 'required|numeric',
                'type' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->route('accounts.create')->withErrors($errors)->withInput();
            }

            $validatedData = $validator->validated();
            Card::create($validatedData);
            return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
        }catch(QueryException $e){
            $errorCode = $e->getCode();
            return redirect()->route('errors.error', compact('errorCode'));
        }
    }

    public function find(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric',
            ]);

            if ($validator->fails())
                return redirect()->route('admin.find.card')->with('error', 'Card ID must be a number!');

            $validatedData = $validator->validated();

            if(Card::find($validatedData['id'])){
                return redirect()->route('admin.edit.card', $validatedData['id']);
            }else{
                return redirect()->route('admin.find.card')->with('error', 'Card not found!');
            }
        }catch(Exception $e){
            $errorCode = $e->getCode();
            return redirect()->route('errors.error', compact('errorCode'));
        }
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validatedData = $request->validate([
            'state' => 'required|in:running,blocked',
        ]);
        // $this->authorize('update', $card); // Policy To prevent the user from updating anyone else's post

        $card->update($validatedData);

        return redirect()->route('admin.card.find')->with('success', 'card type updated updated successfully!');
    }
}
