<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class AdminHome extends Component
{
    public $eventNUM, $event_data, $portion, $regis;

    public function mount($eventNUM,$regis){
        $this->eventNUM = $eventNUM;
        $this->regis = $regis;
    }

    public function render()
    {
        $this->portion = Event::find($this->eventNUM)->portion;
        $this->event_data = Event::find($this->eventNUM);
        return view('livewire.admin-home');
    }

    public function registerClick($data){
        $this->imbed = $data;
    }

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];

    public function click($id,$reg){
        $this->eventNUM = $id;
        $this->imbed = $reg;
    }
}
