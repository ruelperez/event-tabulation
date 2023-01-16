<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;
use function App\Http\Controllers\clean;

class ShowCriteria extends Component
{
    public $show, $show_portion, $title, $percentage, $portion_id, $user_id;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->criteria;
        $this->show_portion = User::find(auth()->user()->id)->portion;
        return view('livewire.show-criteria');
    }

    public function updated($field){
        $this->validateOnly($field, [
            'percentage' => 'integer'
        ]);
    }

    public function submit(){
        $this->validate([
            'portion_id' => 'required|integer',
            'title' => 'required',
            'percentage' => 'required|integer'
        ]);

        try {
            Criteria::create([
                'portion_id' => $this->portion_id,
                'user_id' => $this->user_id,
                'title' => $this->title,
                'percentage' => $this->percentage,
            ]);

            $this->percentage = "";
            $this->title = "";
            $this->portion_id = "";
            session()->flash('criteriaSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Register");
        }


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
