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
    public $event, $por_name, $candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [], $criteria_id = [], $rating=[], $x=1, $total=[], $nums=0;

    public function render()
    {

        $this->judge_id = Auth::guard('webjudge')->user()->id;
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = User::find($auth)->candidate;
        $this->portion = User::find($auth)->portion;

        $cri = User::find($auth)->portion;
        if ($this->ids == 1){
            foreach ($cri as $cris){
                $this->ids = $cris->id;
                break;
            }
        }
        $this->por_name = Portion::find($this->ids)->title;
        $this->criteria = Portion::find($this->ids)->criteria;


        $f = Auth::guard('webjudge')->user()->user_id;
        $can = User::find($f)->candidate;
        $cr = Portion::find($this->ids)->criteria;
        $count = count($cr);
        $d = 1;
        $h=1;
        foreach ($can as $cans){

            foreach ($cr as $crs){
                $this->candidate_id[$h][$d] = $cans->id;
                $this->criteria_id[$h][$d] = $crs->id;

                $d++;
            }
            $h++;
        }


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


}
