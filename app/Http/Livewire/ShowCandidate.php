<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class ShowCandidate extends Component
{
    public $show, $image, $user_id, $event_id, $full_name, $candidate_id, $team_name, $origin;

    public function render()
    {

        $this->user_id = auth()->user()->id;
        $this->event_id = User::find(auth()->user()->id)->event;
        $this->show = User::find(auth()->user()->id)->candidate;

        return view('livewire.show-candidate');
    }

    public function submit(){
//        $this->validate([
//            'full_name' => 'required',
//            'candidate_id' => 'required',
//            'team_name' => 'required',
//            'origin' => 'required',
//        ]);
        $image = $this->storeImage();
        $teamName = $this->teamName();
        $individual = $this->individual();

        Candidate::create([
            'full_name' => $individual,
            'candidate_id' => $this->candidate_id,
            'team_name' => $teamName,
            'origin' => $this->origin,
            'photo' => $image,
            'user_id' => $this->user_id,
            'event_id' => $this->event_id
        ]);


    }

    public function storeImage(){
        if (!$this->image) {
            return null;
        }

        $img = ImageMa

    }

    public function teamName(){
        if (!$this->team_name) {
            return null;
        }else{
            return $this->team_name;
        }
    }

    public function individual(){
        if (!$this->full_name) {
            return null;
        }else{
            return $this->full_name;
        }
    }



    protected $listeners = [
        'deleteCandidate' => 'destroy',
        'fileUpload' => 'handler',
        ];

    public function handler($imageData){
        $this->image = $imageData;
    }

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
