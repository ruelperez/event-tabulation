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
        $final_average_id = 1;
        $table_id = 1;
        $counter =1;
        $u = 1;
        return view('resultScore.result_score', ['u' => $u, 'counter' => $counter, 'table_id' => $table_id, 'final_average_id' => $final_average_id, 'final_average' => $final_average, 'final' => $final, 'portion' => $portion, 'judge' => $judge, 'candidate' => $candidate, 'rating' => $rating, 'criteria' => $criteria]);
    }
}
