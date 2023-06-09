<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Judge;
use App\Models\Portion;
use App\Models\Rating;
use Livewire\Component;

class Unlock extends Component
{
    public $event_id, $portion_id, $key=1, $san, $portion_data, $ras=1;

    public function render()
    {
        return view('livewire.unlock');
    }

    public function mount($eventID,$por_data){
        $this->portion_data = $por_data;
        $this->event_id = $eventID;
//        $this->event_id = $eve_id;
//        $this->portion_id = $por_id;
//        $this->portion_data = Portion::find($por_id);
    }

    protected $listeners = [
        'emitUnlock' => 'unlock',
        'emitLock' => 'lock',
    ];

    public function lock($id){
        $chairman;
        $jud = Judge::where('is_chairman',"1")
            ->select('id')
            ->get();
        foreach ($jud as $juds){
            $gn = \App\Models\Assignment::where('event_id',$this->event_id)
                ->where('judge_id',$juds->id)
                ->where('user_id', auth()->user()->id)
                ->select('judge_id')
                ->get();
        }
        foreach ($gn as $gns){
            $chairman = $gns->judge_id;
        }

        $rate = Rating::where('event_id',$this->event_id)
            ->where('judge_id', $chairman)
            ->where('portion_id',$id)
            ->get();
        foreach ($rate as $rates){
            $rates->isSubmit = 1;
            $rates->save();
        }
        $por = Portion::find($id);
        $por->isLock = 1;
        $por->save();

        $this->portion_data = Event::find($this->event_id)->portion;
//        dd(p)
//        $por->isLock = 1;
    }

    public function unlock($id){
        $chairman;
        $jud = Judge::where('is_chairman',"1")
            ->select('id')
            ->get();
        foreach ($jud as $juds){
            $gn = \App\Models\Assignment::where('event_id',$this->event_id)
                ->where('judge_id',$juds->id)
                ->where('user_id', auth()->user()->id)
                ->select('judge_id')
                ->get();
        }
        foreach ($gn as $gns){
            $chairman = $gns->judge_id;
        }

        $rate = Rating::where('event_id',$this->event_id)
            ->where('judge_id', $chairman)
            ->where('portion_id',$id)
            ->get();
        foreach ($rate as $rates){
            $rates->isSubmit = 0;
            $rates->save();
        }
        $por = Portion::find($id);
        $por->isLock = 0;
        $por->save();

        $this->portion_data = Event::find($this->event_id)->portion;
    }
}

