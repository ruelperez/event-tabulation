<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JudgeEvent extends Component
{
    public $data;

    public function render()
    {
        $cont = \App\Models\Assignment::where('judge_id', Auth::guard('webjudge')->user()->id)->get();
        $hn = [];
        $gn = [];
        foreach ($cont as $con){
            $hn [] = $con->event_id;
        }

        for ($i=0; $i<count($hn); $i++){
            $gn [] = Event::find($hn[$i]);
        }

        $this->data = $gn;

        return view('livewire.judge-event');
    }
}
