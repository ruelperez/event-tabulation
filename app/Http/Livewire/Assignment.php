<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Judge;
use Livewire\Component;

class Assignment extends Component
{
    public $judge, $user_id, $selectData, $addEvent, $ff=1, $selectedJudge, $data, $eventData, $selectEvent;


    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->judge = Judge::where('user_id',$this->user_id)->get();
        if ($this->selectData != null){
            $this->handleSelectChange();
        }
        return view('livewire.assignment');
    }

    public function handleSelectChange(){
        $container = [];
        $cons = [];
        $dat = \App\Models\Assignment::where('judge_id', $this->selectedJudge)->get();
        foreach ($dat as $da){
            $container[] = $da->event_id;
        }

        for ($i=0; $i<count($container); $i++){
            $cons[] = Event::find($container[$i]);
        }

        $this->eventData = $cons;

        $this->selectEvent = Event::where('user_id', $this->user_id)->get();

        $j = 0;
        $display = [];
        $displayTitle = [];

        foreach($this->selectEvent as $all) {
            foreach($this->eventData as $evt) {
                if($all->id == $evt->id) {
                    $j++;
                }

            }
            if($j == 0) {
                $display[] = $all->id;
            }
            else {
                $j = 0;
            }
        }
        for($i = 0; $i < count($display); $i++) {
            $displayTitle[] = Event::find($display[$i]);
        }
        $this->addEvent = $displayTitle;
    }

    public function loadData(){

    }

    public function delete($id){
        $ks;
       $ghh = \App\Models\Assignment::all();
       foreach ($ghh as $gh){
           if ($gh->user_id == $this->user_id and $gh->event_id == $id){
               $ks = $gh->id;
           }
       }

        \App\Models\Assignment::find($ks)->delete();
        $this->handleSelectChange();
    }

    public function submit(){
        \App\Models\Assignment::create([
           'event_id' => $this->selectData,
           'user_id' => $this->user_id,
           'judge_id' => $this->selectedJudge,
        ]);

        $this->handleSelectChange();
    }

}
