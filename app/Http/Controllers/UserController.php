<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            "name" => 'required',
            "username" =>['required', Rule::unique('users','username')],
            "password" => 'required|confirmed|min:5',
            "is_chairman" => 'required'
        ]);

        //$validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        if($validated['is_chairman'] == 1){
            $chairman = "Chairman";
        }
        else{
            $chairman = "";
        }

        auth()->login($user);

        return view('home');

    }
}
