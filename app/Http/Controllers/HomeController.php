<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $eve = User::find(auth()->user()->id)->event;
        if (count($eve) <= 0){
            return view('home');
        }
        else{

            $events = User::find(auth()->user()->id)->event;
            foreach ($events as $eventss){
                $eventID = $eventss->id;
            }

            return view('home', ['eventID'=>$eventID]);
        }

    }
}
