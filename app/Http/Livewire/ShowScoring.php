<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Judge;
use App\Models\Portion;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $judge_profile, $try,$candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [], $tot, $total_data, $rmm,
            $criteria_id = [], $rating=[], $x=1, $total=[], $pass, $num=1, $ber=1, $r, $datas, $u=1, $z=1, $jk = 1, $rtt=[], $xa = 1, $sa = 0;

    public function render()
    {

        $this->judge_profile = Auth::guard('webjudge')->user();
        $this->judge_id = Auth::guard('webjudge')->user();
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = User::find($auth)->candidate;
        $this->portion = User::find($auth)->portion;
        $this->criteria = User::find($auth)->criteria;
        $this->displayScoreData();
        return view('livewire.show-scoring');
    }

    public function submit(){
        $u = count($this->criteria);
        $e = 1;
        for ($i=1; $i<=count($this->candidate); $i++){

            while ($e <= $u){
                Rating::create([
                    'judge_id' => $this->judge_id,
                    'candidate_id' => $this->candidate_id[$i][$e],
                    'criteria_id' => $this->criteria_id[$i][$e],
                    'rating' => $this->rating[$i][$e],
                ]);
                $e++;
            }
            $u += count($this->criteria);
        }
    }

    public function fetch($id){
        $this->ids = $id;
        $this->rating = [];
    }

    public function select($id){
        $this->num = $id;
    }

    public function getData($id){
        $this->pass = $id;
        $this->num = 2;
        $this->ber = 2;
    }

    protected $listeners = [
        'emitScore' => 'dataScore',
        'rateEmit' => 'scoreRate',
    ];

    public function scoreRate($rating,$candidate,$criteria){
//        dd($rating);
        $judgeID = Auth::guard('webjudge')->user()->id;
        $count = count($rating)-1;
        $rt = Rating::all();
        $y = 1;

        $e = 1;

        foreach ($rt as $rts){
           $e = 0;
            break;
        }

        if ($e == 1){

            for ($i = 1; $i <= $count; $i++){

                Rating::create([
                    'judge_id' => $judgeID,
                    'rating' => $rating[$i],
                    'candidate_number' => $candidate[$i],
                    'criteria_id' => $criteria[$i],
                ]);
            }

        }
        elseif ($e == 0){

            foreach ($rt as $rts){
               $rts->judge_id = $judgeID;
               $rts->rating = $rating[$y];
               $rts->candidate_number = $candidate[$y];
               $rts->criteria_id = $criteria[$y];
               $rts->save();
                $y++;
            }

        }

        $this->displayScoreData();





//        foreach ($rr as $rrs){
//            $this->xa = 1;
//            $this->rtt[$er] = $rrs->rating;
//            $er++;
//        }

//        if ($trax != 0){
//            foreach ($rt as $rts){
//               $rts->judge_id = $judgeID;
//               $rts->rating = $rating[$y];
//               $rts->candidate_number = $candidate[$y];
//               $rts->criteria_id = $criteria[$y];
//               $y++;
//               $rt->save();
//            }
//
//        }
//        else{
//            for ($i = 1; $i <= $count; $i++){
//
//                Rating::create([
//                    'judge_id' => $judgeID,
//                    'rating' => $rating[$i],
//                    'candidate_number' => $candidate[$i],
//                    'criteria_id' => $criteria[$i],
//                ]);
//            }
//        }


    }

    public function displayScoreData(){
        $er = 1;
        $re = 1;
        $equal = 0;
        $dh = 1;
        $ram = 1;
        $rr = Rating::all();
        $pn = $this->portion;
        $ca = $this->criteria;
        $can = $this->candidate;

        foreach ($rr as $rrs){
            $this->xa = 1;
            $this->rtt[$er] = $rrs->rating;
            $er++;
        }

        foreach ($rr as $rrs){
            $this->rmm[$ram] = $rrs->rating;
            $ram++;
        }


        foreach ($pn as $pns){

            foreach ($can as $cans){

                foreach ($ca as $cas){

                    if ($pns->id == $cas->portion_id){

                        $this->sa = 1;
                        $this->rmm[$re] *= '.'.$cas->percentage;
                        $equal += $this->rmm[$re];
                        $re++;

                    }
                }

                $this->total_data[$dh] = $equal;
                $equal = 0;
                $dh++;
            }


        }
    }

    public function dataScore($data,$x){
    $this->r = $x;
    $this->datas = $data;
    }


}
