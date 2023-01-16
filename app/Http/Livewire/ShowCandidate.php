<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;

class ShowCandidate extends Component
{
    public $show, $image, $user_id, $event_id, $full_name, $candidate_id, $origin;

    public function render()
    {

        $this->user_id = auth()->user()->id;
        $this->eventID();
        $this->show = User::find(auth()->user()->id)->candidate;
        return view('livewire.show-candidate');
    }

    public function submit(){
        $this->validate([
            'full_name' => 'required',
            'candidate_id' => 'required|integer',
            'origin' => 'required',
        ]);

        $active = User::find(auth()->user()->id)->candidate;
        foreach ($active as $actives){
            if ($actives->id == $this->candidate_id){
                session()->flash('idInputError', 'Input unique candidate number');
                return;
            }
        }
        $image = $this->storeImage();
        try {
            Candidate::create([
                'full_name' => $this->full_name,
                'id' => $this->candidate_id,
                'origin' => $this->origin,
                'photo' => $image,
                'user_id' => $this->user_id,
                'event_id' => $this->event_id
            ]);
            $this->resetInput();
            session()->flash('dataAdded',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('dataError',"Failed to Register");
        }


    }

    public function resetInput(){
        $this->full_name = "";
        $this->candidate_id = "";
        $this->team_name = "";
        $this->origin = "";
        $this->image = "";
    }

    public function eventID(){
        $event = User::find(auth()->user()->id)->event;
        foreach ($event as $events){
            $this->event_id = $events->id;
        }
    }

    public function storeImage(){
        if (!$this->image) {
            return "null";
        }
        $img =  ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;

    }


    protected $listeners = [
        'deleteCandidate' => 'destroy',
        'fileUpload' => 'handler',
        ];

    public function handler($imageData){
        $this->image = $imageData;
    }

    public function destroy($id){
         $del = Candidate::find($id)->photo;
        try {
            Storage::disk('public')->delete($del);
            Candidate::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
