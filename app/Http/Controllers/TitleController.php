<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function store(Request $request){

        Title::create([
            'name' => $request->name
        ]);

        return redirect('/home')->with('message_title', 'Data Save!!!');

    }
}
