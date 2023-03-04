<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\Event;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class TitleAward extends Component
{
    public $event_id, $award_data, $portion_id, $show, $user_id, $award_name, $portion_name, $award_id;

    public function render()
    {
        $this->show = Event::find($this->event_id)->portion;
        $this->award_data = Event::find($this->event_id)->award;
        return view('livewire.title-award');
    }

    public function mount($eventNUM){
        $this->event_id = $eventNUM;
    }

    public function submit_award(){
        $op=$this->validate([
             'portion_id' => 'required',
            'user_id' => 'required',
            'award_name' => 'required',
            'event_id' => 'required',
        ]);
        try {
            Award::create([
                'portion_id' => $this->portion_id,
                'event_id' => $this->event_id,
                'user_id' => $this->user_id,
                'award_name' => $this->award_name,
            ]);

            $this->award_name = "";
            session()->flash('awardAdded',"Successfully Saved");
        }
        catch (\Exception $e){
            session()->flash('awardError',"failed to save");
        }

    }

    public function table($id){
        $this->portion_id = $id;
        $this->user_id = auth()->user()->id;
        $this->portion_name = Portion::find($id)->title;

    }

    public function close(){
        $this->portion_id = "";
        $this->user_id = "";
        $this->portion_name = "";
    }

    public function delete_award($id){
        Award::find($id)->delete();

    }

    public function edit_award($id){
        $ka = Award::find($id);
        $this->portion_id = $ka->portion_id;
        $this->user_id = $ka->user_id;
        $this->event_id = $ka->event_id;
        $this->award_name = $ka->award_name;
        $this->award_id = $id;
    }

    public function submit_edit(){
        $this->validate([
            'portion_id' => 'required',
            'user_id' => 'required',
            'award_name' => 'required',
            'event_id' => 'required',
        ]);

        try {
            $ok = Award::find($this->award_id);
            $ok->user_id = $this->user_id;
            $ok->event_id = $this->event_id;
            $ok->portion_id = $this->portion_id;
            $ok->award_name = $this->award_name;
            $ok->save();
            session()->flash('awardEdited',"Successfully Updated");
            $this->award_name = "";
        }
        catch (\Exception $e){
            session()->flash('awardFailed',"failed to update");
        }

    }
}
