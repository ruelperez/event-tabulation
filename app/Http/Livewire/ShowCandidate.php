<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use Livewire\Component;

class ShowCandidate extends Component
{
    public $show;
//    public $show, $first_name, $last_name, $address, $team_name;
//
//    public function store(){
//        // Validate Form Request
//        $this->validate();
//
//        try{
//            Candidate::create([
//                'first_name'=>$this->first_name,
//                'last_name'=>$this->last_name,
//                'team_name'=>$this->team_name,
//                'address' =>$this->address
//            ]);
//
//            // Set Flash Message
//            session()->flash('success','Created Successfully!!');
//
//            // Reset Form Fields After Creating Post
//            $this->resetFields();
//        }catch(\Exception $e){
//            // Set Flash Message
//            session()->flash('error','Something goes wrong while creating!!');
//
//            // Reset Form Fields After Creating Post
//            $this->resetFields();
//        }
//    }
//
//    public function resetFields(){
//        $this->first_name = '';
//        $this->last_name = '';
//        $this->team_name = '';
//        $this->address = '';
//    }


    public function render()
    {
        $this->show = Candidate::all();
        return view('livewire.show-candidate');
    }

    protected $listeners = [
        'deleteCandidate' => 'destroy'
        ];

    public function destroy($id){
        try {
            Candidate::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }
}
