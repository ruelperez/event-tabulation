<?php

namespace App\Http\Livewire;

use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowPortion extends Component
{
    public $show, $title, $user_id, $event_id;

    public function render()
    {
        $this->eventID();
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->portion;
        return view('livewire.show-portion');
    }

    public function eventID(){
        $datas = User::find(auth()->user()->id)->event;
        foreach ($datas as $data){
            $this->event_id = $data->id;
        }
    }

    public function submit(){
        $prtn = User::find(auth()->user()->id)->event;
        if (count($prtn) == "0"){
            $this->title = "";
            session()->flash('portionError','Failed! (Register first an Event Title)');
            return;
        };
        $this->validate(['title' => 'required']);
        try {
            Portion::create([
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'title' => $this->title,
            ]);
            $this->title = "";
            session()->flash('portionSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('portionError',"Failed to Register");
        }


    }

    protected $listeners = [
        'deleteTitles' => 'destroy'
    ];

    public function destroy($id){
        try {
            Portion::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
