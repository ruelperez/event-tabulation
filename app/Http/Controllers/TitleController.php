<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function store(Request $request){

        Event::create([
            'title' => $request->name
        ]);

        return redirect('/home')->with('message_title', 'Data Save!!!');

    }
}
