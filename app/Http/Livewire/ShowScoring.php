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
use function Termwind\style;

class ShowScoring extends Component
{
    public $event, $s, $prtn, $ss, $candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [], $criteria_id = [], $rating=[], $x=1, $nums=0;

    public function render()
    {
        $this->judge_id = Auth::guard('webjudge')->user()->id;
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = User::find($auth)->candidate;
        $this->portion = User::find($auth)->portion;

        $pr = User::find($auth)->portion;
        if ($this->ids == 1){
            foreach ($pr as $prs){
                $this->ids = $prs->id;
                break;
            }
        }
        $this->prtn = Portion::find($this->ids)->title;
        $this->criteria = Portion::find($this->ids)->criteria;


        $f = Auth::guard('webjudge')->user()->user_id;
        $can = User::find($f)->candidate;
        $cr = Portion::find($this->ids)->criteria;
        $count = count($cr);
        $d = 1;
        foreach ($can as $cans){

            foreach ($cr as $crs){
                $this->candidate_id[$d] = $cans->id;
                $this->criteria_id[$d] = $crs->id;

                $d++;
            }

        }

        return view('livewire.show-scoring');
    }

    public function submit(){
        for ($i=1; $i<=count($this->rating); $i++){
            Rating::create([
                'judge_id' => $this->judge_id,
                'candidate_id' => $this->candidate_id[$i],
                'criteria_id' => $this->criteria_id[$i],
                'rating' => $this->rating[$i],
            ]);

        }
        $this->ss = "disable";

    }

    public function fetch($id){
        if ($id == $this->ids){

        }
        else{
            $this->ids = $id;
            $this->rating=[];

        }


    }

}
