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
    public $event, $judge_profile, $try,$candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [],
            $criteria_id = [], $rating=[], $x=1, $total=[], $pass, $num=1, $ber=1, $r, $datas, $u=1, $z=1;

    public function render()
    {

        $this->judge_profile = Auth::guard('webjudge')->user();
        $this->judge_id = Auth::guard('webjudge')->user();
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = User::find($auth)->candidate;
        $this->portion = User::find($auth)->portion;
        $this->criteria = User::find($auth)->criteria;

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

    ];

    public function dataScore($data,$x){
    $this->r = $x;
    $this->datas = $data;
    }


}
