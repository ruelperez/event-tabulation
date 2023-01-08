<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function store(Request $request){
            $event = User::find(auth()->user()->id)->event;
            if (count($event) >= 1){
                return redirect('/home')->with('message_title_error', 'Unable to add another event, Only one event is allowed');
            }
            else{
                Event::create([
                    'title' => $request->name,
                    'user_id' => $request->user_id
                ]);

                return redirect('/admin/home')->with('message_title', 'Data Save!!!');
            }


    }
}
