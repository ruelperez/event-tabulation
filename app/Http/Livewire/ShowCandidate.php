<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;

class ShowCandidate extends Component
{
    public $show, $image, $user_id, $event_id, $full_name, $candidate_number, $can_num, $origin, $anti=1, $IDs;

    public function mount($eventNUM){
        $this->event_id = $eventNUM;
    }

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->candidate;
        return view('livewire.show-candidate');
    }

    public function submit(){
        $jg = Event::find($this->event_id)->candidate;
        if (count($jg) > 0){

            foreach ($jg as $jgs){
                if ($jgs->candidate_number == $this->candidate_number){
                    session()->flash('idInputError', 'Input unique candidate number');
                    return;
                }
            }

        }

        $this->validate([
            'full_name' => 'required',
            'candidate_number' => 'required|integer',
            'origin' => 'required',
        ]);

        $image = $this->storeImage();
        try {
            Candidate::create([
                'full_name' => $this->full_name,
                'candidate_number' => $this->candidate_number,
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
        $this->candidate_number = "";
        $this->origin = "";
        $this->image = "";
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
        'fileCan' => 'handleCan',
        ];

    public function handleCan($imageData){
        dd($imageData);
        $this->image = $imageData;
        $this->anti++;
    }

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

    public function edit_can($id){
        $can = Candidate::find($id);
        $this->candidate_number = $can->candidate_number;
        $this->can_num = $can->candidate_number;
        $this->event_id = $can->event_id;
        $this->user_id = $can->user_id;
        $this->full_name = $can->full_name;
        $this->origin = $can->origin;
        $this->image = $can->photo;
        $this->IDs = $can->id;
    }

    public function edit_submit(){
        $this->validate([
            'full_name' => 'required',
            'candidate_number' => 'required',
            'event_id' => 'required',
            'user_id' => 'required',
            'origin' => 'required',
            'image' => 'required',
        ]);

        $active = Event::find($this->event_id)->candidate;
        foreach ($active as $actives){
            if ($this->can_num == $this->candidate_number){
                break;
            }
            elseif ($actives->candidate_number == $this->candidate_number and $this->can_num != $this->candidate_number){
                session()->flash('idInputError', 'Input unique candidate number');
                return;
            }
        }

        if ($this->anti != 1){
            $pic = $this->storeImage();
        }
        else{
            $pic = $this->image;
        }

        try {
            $new = Candidate::find($this->IDs);
            $new->user_id = $this->user_id;
            $new->event_id = $this->event_id;
            $new->candidate_number = $this->candidate_number;
            $new->full_name = $this->full_name;
            $new->origin = $this->origin;
            $new->photo = $pic;
            $new->save();
            $this->anti = 1;
            $this->full_name = "";
            $this->image = "";
            $this->origin = "";
            $this->candidate_number = "";
            session()->flash('dataAdded',"Successfully Updated Data");
        }
        catch (\Exception $e){
            session()->flash('dataError',"Something goes wrong while Editing!!");
        }
    }
}
