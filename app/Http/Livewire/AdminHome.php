<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class AdminHome extends Component
{
    public $eventNUM, $event_data;

    public function mount($eventNUM){
        $this->eventNUM = $eventNUM;
    }

    public function render()
    {
        $this->event_data = Event::find($this->eventNUM);
        return view('livewire.admin-home');
    }
}
