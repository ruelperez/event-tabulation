<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function store(Request $request){
        if ($request->event_id == "null"){
            return redirect('/admin/home')->with('candidate_error','Register first an Event Title');
        }

        $can = User::find(auth()->user()->id)->candidate;

        if (count($can) < 1){

            Candidate::create([
                'candidate_num' => $request->candidate_num,
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'team_name' => $request->team_name,
                'origin' => $request->origin,
                'photo' => $request->photo
            ]);

            return redirect('/admin/home')->with('message_can', 'Data Save!!!');
        }
        else{
            foreach ($can as $cans){
                if ($cans->candidate_num == $request->candidate_num){
                    return redirect('/admin/home')->with('can_num_error','Failed! Enter different Candidate Number');
                }
            }
            Candidate::create([
                'candidate_num' => $request->candidate_num,
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'team_name' => $request->team_name,
                'origin' => $request->origin,
                'photo' => $request->photo
            ]);

            return redirect('/admin/home')->with('can_num_save', 'Data Save');
        }

    }
}
