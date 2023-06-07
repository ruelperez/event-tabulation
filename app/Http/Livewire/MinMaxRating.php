<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class MinMaxRating extends Component
{
    public $event_id, $min, $max, $user_id, $data;


    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->data = \App\Models\MinMaxRating::where('event_id', $this->event_id)->get();
        return view('livewire.min-max-rating');
    }

    public function mount($eventNUM){
        $this->event_id = $eventNUM;
    }

    public function submit(){
        $mix_max_data = Event::find($this->event_id)->min_max_rating;
        if(count($mix_max_data) == 1){
            foreach ($mix_max_data as $sa){
                $ids = $sa->id;
                break;
            }
           $xz = \App\Models\MinMaxRating::find($ids);
            $xz->min = $this->min;
            $xz->max = $this->max;
            $xz->event_id = $this->event_id;
            $xz->user_id = $this->user_id;
            $xz->save();

            $this->min = "";
            $this->max = "";
        }
        elseif(count($mix_max_data) == 0){
            \App\Models\MinMaxRating::create([
                'min' => $this->min,
                'max' => $this->max,
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
            ]);
        }

    }
}
