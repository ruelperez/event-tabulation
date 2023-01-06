<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JudgeController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            "event_id" => 'required',
            "full_name" => 'required',
            "username" =>['required', Rule::unique('judges','username')],
            "password" => 'required|confirmed|min:5',
            "is_chairman" => 'required',
            "photo" => 'required'
        ]);

        //$validated['password'] = bcrypt($validated['password']);

        $judge = Judge::create($validated);

//        auth()->login($user);

        return redirect('/home')->with('message_jud', 'Data Save!!!');

    }
}
