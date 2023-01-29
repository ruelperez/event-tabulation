<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request){
        $candidate = $request->candidate_number;
        $judge = $request->judge_id;
        $criteria = $request->criteria_id;
        $rating = $request->rating;

        for ($i=1; $i <= count($rating); $i++){
            $datasave = [
                'judge_id' => $judge,
                'criteria_id' => $criteria[$i],
                'candidate_number' => $candidate[$i],
                'rating' => $rating[$i],
            ];
            Rating::create($datasave);
            return redirect('/judge/scoring-page');
        }
    }
}
