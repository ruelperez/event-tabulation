<?php

namespace App\Http\Controllers;

use App\Models\Portion;
use Illuminate\Http\Request;

class PortionController extends Controller
{
    public function store(Request $request){

        Portion::create([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'title' => $request->title
        ]);

        return redirect('/admin/home')->with('message_portion', 'Data Save!!!');

    }
}
