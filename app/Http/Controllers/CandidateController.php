<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function store(Request $request, $candidate){

        if($candidate == "individual"){

            Candidate::create([
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'team_name' => $request->team_name,
                'origin' => $request->origin,
                'photo' => $request->photo
            ]);

            return redirect('/home')->with('message_can', 'Data Save!!!');
        }
        else{
            Candidate::create([
                'event_id' => $request->event_id,
                'user_id' => $request->event_id,
                'full_name' => $request->full_name,
                'team_name' => $request->team_name,
                'origin' => $request->origin,
                'photo' => $request->photo
            ]);

            return redirect('/home')->with('message_can', 'Data Save!!!');
        }
    }
}
