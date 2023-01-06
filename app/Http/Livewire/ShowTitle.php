<?php

namespace App\Http\Livewire;


use App\Models\Event;
use Livewire\Component;

class ShowTitle extends Component
{
    public $show;

    public function render()
    {
        $this->show = Event::all();
        return view('livewire.show-title');
    }

    protected $listeners = [
        'deleteTitle' => 'destroy'
    ];

    public function destroy($id){
        try {
            Event::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
