<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Portion;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $candidate, $portion, $criteria, $na, $ids = 1;


    public function render()
    {
        $this->event = Event::all();
        $this->candidate = Candidate::all();
        $this->portion = Portion::all();
        $this->criteria = Portion::find($this->ids)->criteria;
        return view('livewire.show-scoring');
    }

    public function fetch_Criteria($id){
        $this->ids = $id;
    }

}
