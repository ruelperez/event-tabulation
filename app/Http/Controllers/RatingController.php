<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request){
        $candidate = $request->candidate;
        $judge = $request->judge;
        $criteria = $request->criteria;
        $rating = $request->rating;

        for ($i=0; $i< count($rating); $i++){
            $datasave = [
                'judge_id' => $judge[$i],
                'criteria_id' => $criteria[$i],
                'candidate_id' => $candidate[$i],
                'rating' => $rating[$i],
            ];
            Rating::create($datasave);
        }
    }
}
