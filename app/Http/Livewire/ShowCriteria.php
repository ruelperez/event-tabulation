<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowCriteria extends Component
{
    public $show, $show_portion;

    public function render()
    {
        $this->show = User::find(auth()->user()->id)->criteria;
        $this->show_portion = User::find(auth()->user()->id)->portion;
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
