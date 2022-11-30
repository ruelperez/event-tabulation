<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request, $reg ){

        if ($reg == "judges"){
            $validated = $request->validate([
                "name" => 'required',
                "username" =>['required', Rule::unique('users','username')],
                "password" => 'required|confirmed|min:5',
                "user_type" => 'required'
            ]);

            //$validated['password'] = bcrypt($validated['password']);

            $user = User::create($validated);

            auth()->login($user);

            return view('home');
        }

        elseif ($reg == "candidate"){
            $validated = $request->validate([
                "first_name" => 'required',
                "last_name" => 'required',
                "team_name" => '',
                "address" => 'required',
                "photos" =>''
            ]);

            Candidate::create($validated);

            $candidate = Candidate::all();

            return view('home', ['candidate' => $candidate]);
        }



    }
}
