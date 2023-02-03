<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Portion;
use App\Models\Rating;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ShowResult extends Component
{
    public $portion, $criteria, $judge, $candidate, $rating, $decimal = "0.", $r=0, $final=0, $t;

    protected $listeners= ['refreshResult' => '$refresh'];

    public function render(): \Illuminate\Contracts\View\View
    {
        $this->portion = User::find(auth()->user()->id)->portion;
        $this->judge = User::find(auth()->user()->id)->judge;
        $this->candidate = User::find(auth()->user()->id)->candidate;
        $this->rating = Rating::all();
        $this->criteria = Criteria::all();
        return view('livewire.show-result');
    }
}
