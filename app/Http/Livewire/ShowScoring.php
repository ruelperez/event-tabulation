<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Portion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $candidate, $portion, $criteria, $ids = 1;

    public function render()
    {

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

        $this->criteria = Portion::find($this->ids)->criteria;


        return view('livewire.show-scoring');
    }

    public function fetch($id){
        $this->ids = $id;
    }

    public function select($id){
        $this->num = $id;
    }


}
