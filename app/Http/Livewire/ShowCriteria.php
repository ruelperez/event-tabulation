<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use Livewire\Component;

class ShowCriteria extends Component
{
    public $show, $show_portion;

    public function render()
    {
        $this->show = Criteria::all();
        $this->show_portion = Portion::all();
        return view('livewire.show-criteria');
    }

    protected $listeners = [
        'deleteCriteria' => 'destroy'
    ];

    public function destroy($id){
        try {
            Criteria::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
