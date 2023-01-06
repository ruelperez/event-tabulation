<?php

namespace App\Http\Controllers;

use App\Models\Portion;
use Illuminate\Http\Request;

class PortionController extends Controller
{
    public function store(Request $request){

        Portion::create([
            'event_id' => $request->event_id,
            'title' => $request->title
        ]);

        return redirect('/home')->with('message_portion', 'Data Save!!!');

    }
}
