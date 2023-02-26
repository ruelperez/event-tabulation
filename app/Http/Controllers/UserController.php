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
                "role" => 'required',
                "name" => 'required',
                "username" =>['required', Rule::unique('users','username')],
                "password" => 'required|confirmed|min:5'
            ]);

            $validated['password'] = bcrypt($validated['password']);

            $user = User::create($validated);

            auth()->login($user);

            return redirect('/admin/event')->with('message_user', 'welcome!!!');

        }

        public function login(Request $request){

            $validated = $request->validate([
                "username" => 'required',
                "password" => 'required'
            ]);

            if(auth()->attempt($validated)){
                $request->session()->regenerate();

                return redirect('/admin/event');
            }
            return back()->withErrors(['username' => 'login failed']);
        }

        public function logout(Request $request){
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin/login');
        }
}
