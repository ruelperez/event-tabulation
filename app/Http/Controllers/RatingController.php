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
        $max = $request->maxX;

        $i = $max - count($rating);
        $max--;
        while ($i <= $max){
            $datasave = [
                'judge_id' => $judge,
                'criteria_id' => $criteria[$i],
                'candidate_number' => $candidate[$i],
                'rating' => $rating[$i],
            ];
            Rating::create($datasave);
            $i++;
        }
        return redirect('/judge/scoring-page');
    }
}
