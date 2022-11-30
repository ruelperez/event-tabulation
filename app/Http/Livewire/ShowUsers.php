<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{
    public function render()
    {
        $show = User::all(['name','is_chairman']);
        return view('livewire.show-users', ['show' => $show]);
    }
}
