<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
                "user_type" => 'required'
            ]);

            //$validated['password'] = bcrypt($validated['password']);

            $user = User::create($validated);

            auth()->login($user);

            return redirect('/home')->with('message_jud', 'Data Save!!!');

        }
}
