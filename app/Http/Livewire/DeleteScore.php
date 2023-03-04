<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Extra_toplist;
use App\Models\Judge;
use App\Models\Rating;
use App\Models\Toplist;
use App\Models\User;
use Livewire\Component;

class DeleteScore extends Component
{
    public $eventID;

    public function mount($eventNUM){
        $this->eventID = $eventNUM;

    }


    public function render()
    {
        return view('livewire.delete-score');
    }

    public function deleteAll($eventID){
        $io = Event::find($eventID)->toplist;
        foreach ($io as $ios){
            Toplist::find($ios->id)->delete();
        }

        $a = Event::find($eventID)->toplist;
        $b = Event::find($eventID)->extra_toplist;

        foreach ($a as $as){
            Toplist::find($as->id)->delete();
        }

        foreach ($b as $bs){
            Extra_toplist::find($bs->id)->delete();
        }

        $tt = Event::find($eventID)->judge;
        foreach ($tt as $tts){
            $aser[] = $tts->id;
        }
        for ($fr = 0; $fr<count($aser); $fr++){
            $ju[]=Judge::find($aser[$fr])->rating;
        }

        for ($ki = 0; $ki<count($ju); $ki++){
            if (count($ju[$ki]) == 0){
                session()->flash('deleted',"Deleted Successfully!!");
            }
            else{
                foreach ($ju[$ki] as $del){
                    try {
                        Rating::find($del->id)->delete();
                        session()->flash('deleted',"Deleted Successfully!!");
                    }
                    catch(\Exception $e){
                        session()->flash('failed',"Something goes wrong while deleting!!");
                    }

                }
            }

        }

    }
}
