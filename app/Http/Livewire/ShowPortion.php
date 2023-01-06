<?php

namespace App\Http\Livewire;

use App\Models\Portion;
use Livewire\Component;

class ShowPortion extends Component
{
    public $show;

    public function render()
    {
        $this->show = Portion::all();
        return view('livewire.show-portion');
    }

    protected $listeners = [
        'deleteTitles' => 'destroy'
    ];

    public function destroy($id){
        try {
            Portion::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
