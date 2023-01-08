<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $candidate, $portion, $criteria, $na, $ids = 1;


    public function render()
    {
        $this->event = User::find(auth()->user()->id)->event;
        $this->candidate = User::find(auth()->user()->id)->candidate;
        $this->portion = User::find(auth()->user()->id)->portion;
        $this->criteria = User::find(auth()->user()->id)->criteria;
        return view('livewire.show-scoring');
    }

    public function fetch_Criteria($id){
        $this->ids = $id;
    }

}
