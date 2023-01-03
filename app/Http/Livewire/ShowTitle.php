<?php

namespace App\Http\Livewire;


use App\Models\Title;
use Livewire\Component;

class ShowTitle extends Component
{
    public $show;

    public function render()
    {
        $this->show = Title::all();
        return view('livewire.show-title');
    }

    protected $listeners = [
        'deleteTitle' => 'destroy'
    ];

    public function destroy($id){
        try {
            Title::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
