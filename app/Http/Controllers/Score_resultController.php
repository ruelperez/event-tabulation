<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class Score_resultController extends Controller
{
    public function getData(){
        $portion = User::find(auth()->user()->id)->portion;
        $judge = User::find(auth()->user()->id)->judge;
        $candidate = User::find(auth()->user()->id)->candidate;
        $rating = Rating::all();
        $criteria = Criteria::all();
        $final = 0;
        $final_average = 0;
        return view('resultScore.result_score', ['final_average' => $final_average, 'final' => $final, 'portion' => $portion, 'judge' => $judge, 'candidate' => $candidate, 'rating' => $rating, 'criteria' => $criteria]);
    }
}
