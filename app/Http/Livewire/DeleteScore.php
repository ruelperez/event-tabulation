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

//        $tt = Event::find($eventID)->judge;
//        foreach ($tt as $tts){
//            $aser[] = $tts->id;
//        }
//        for ($fr = 0; $fr<count($aser); $fr++){
//            $ju[]=Judge::find($aser[$fr])->rating;
//        }

        $rate = Rating::where('event_id', $this->eventID)->get();

            if (count($rate) == 0){
                session()->flash('deleted',"Deleted Successfully!!");
            }
            else{
                try {
                    Rating::where('event_id', $this->eventID)->delete();
                    session()->flash('deleted',"Deleted Successfully!!");
                }
                catch(\Exception $e){
                    session()->flash('failed',"Something goes wrong while deleting!!");
                }


            }



    }
}
