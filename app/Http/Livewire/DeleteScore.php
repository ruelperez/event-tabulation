<?php

namespace App\Http\Livewire;

use App\Models\Judge;
use App\Models\Rating;
use App\Models\User;
use Livewire\Component;

class DeleteScore extends Component
{
    public function render()
    {
        return view('livewire.delete-score');
    }

    public function deleteAll(){
        $tt = User::find(auth()->user()->id)->judge;
        foreach ($tt as $tts){
            $aser[] = $tts->id;
        }
        for ($fr = 0; $fr<count($aser); $fr++){
            $ju[]=Judge::find($aser[$fr])->rating;
        }

        for ($ki = 0; $ki<count($ju); $ki++){
            if (count($ju[$ki]) == 0){
                session()->flash('failed',"Something goes wrong while deleting!!");
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
