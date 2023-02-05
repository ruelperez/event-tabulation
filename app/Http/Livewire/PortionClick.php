<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class PortionClick extends Component
{
    public $portionClick, $sp=1;

    public function render()
    {

        $this->portionClick = User::find(auth()->user()->id)->portion;
        return view('livewire.portion-click');
    }

    public function click(){
        $this->sp = $id;
    }
}
