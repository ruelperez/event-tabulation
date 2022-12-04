<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function store(Request $request, $candidate){

        if($candidate == "individual"){

            Candidate::create([
                'fullname' => $request->fullname,
                'team_name' => $request->team_name,
                'address' => $request->address,
                'photo' => $request->photo
            ]);

            return redirect('/home')->with('message_can', 'Data Save!!!');
        }
        else{
            Candidate::create([
                'fullname' => $request->fullname,
                'team_name' => $request->team_name,
                'address' => $request->address,
                'photo' => $request->photo
            ]);

            return redirect('/home')->with('message_can', 'Data Save!!!');
        }
    }
}
