<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginJudge extends Component
{
    public $username, $password;

    public function render()
    {

        return view('livewire.login-judge');
    }

    public function submit(){

        $validated = $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        Auth::guard('webjudge')->attempt($validated);
        if (Auth::guard('webjudge')->attempt($validated)){
            return $this->redirect('/judge/event');
        }
        else{
            session()->flash('loginError', 'Login Failed, Wrong Username/Password');
        }




    }
}
