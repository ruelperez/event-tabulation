<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use Livewire\Component;

class ShowCandidate extends Component
{
    public function render()
    {
        $show = Candidate::all();
        return view('livewire.show-candidate', ['show' => $show]);
    }
}
