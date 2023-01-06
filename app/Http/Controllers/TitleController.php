<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function store(Request $request){

        $event = Event::all();
        if (count($event) >= 1){
            return redirect('/home')->with('message_title_error', 'Unable to register another one, Only one event is allowed');
        }
        else{
            Event::create([
                'title' => $request->name
            ]);

            return redirect('/home')->with('message_title', 'Data Save!!!');
        }



    }
}
