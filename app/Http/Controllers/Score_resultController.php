<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Event;
use App\Models\Portion;
use App\Models\Rating;
use App\Models\Toplist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Score_resultController extends Controller
{
    public function getData($porID){
        $portion = Portion::find($porID);

        $judge = Event::find($portion->event_id)->judge;
        $candidate = Event::find($portion->event_id)->candidate;
        $rating = Rating::all();
        $criteria = Criteria::all();
        $toplist = DB::table('toplists')->orderBy('result','desc')->get();

        if (count($toplist) <= 0){
            $rank_data = 0;
        }
        else{

            foreach ($toplist as $toplists){
                $ran[] = $toplists->id;
            }

            for ($n = 0; $n<count($ran); $n++){
                $rank_data[] = Toplist::find($ran[$n])->candidate;
            }

        }


        $final = 0;
        $final_average = 0;
        $final_average_id = 1;
        $table_id = 1;
        $counter =1;
        $u = 1;

        return view('resultScore.result_score', ['rankData' => $rank_data, 'u' => $u, 'counter' => $counter, 'table_id' => $table_id, 'final_average_id' => $final_average_id, 'final_average' => $final_average, 'final' => $final, 'portion' => $portion, 'judge' => $judge, 'candidate' => $candidate, 'rating' => $rating, 'criteria' => $criteria]);
    }

    public function getPortion($eventID){
        $rt = Event::find($eventID)->portion;

        return view('selectResult', ['portion_data' => $rt]);
    }
}
