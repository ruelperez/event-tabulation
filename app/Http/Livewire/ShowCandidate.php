<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class ShowCandidate extends Component
{
    public $show;

    public function render()
    {
        $this->show = User::find(auth()->user()->id)->candidate;

        return view('livewire.show-candidate');
    }

    protected $listeners = [
        'deleteCandidate' => 'destroy'
        ];

    public function destroy($id){
        try {
            Candidate::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
