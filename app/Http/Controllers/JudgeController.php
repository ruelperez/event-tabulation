<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JudgeController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            "event_id" => 'required',
            "user_id" => 'required',
            "full_name" => 'required',
            "username" =>['required', Rule::unique('judges','username')],
            "password" => 'required|confirmed|min:5',
            "is_chairman" => 'required',
            "photo" => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $judge = Judge::create($validated);

        auth()->login($judge);

        return redirect('/admin/home')->with('message_jud', 'Data Save!!!');

    }

    public function process(Request $request){
        $validated = $request->validate([
            "username" => 'required',
            "password" => 'required'
        ]);

        if(Auth::guard('webjudge')->attempt($validated)){
            $request->session()->regenerate();

            return redirect('/judge/scoring-page');
        }
        return back()->withErrors(['username' => 'login failed']);
    }

//    public function logout(Request $request){
//        auth()->logout();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//
//        return redirect('/judge/login');
//    }

}
