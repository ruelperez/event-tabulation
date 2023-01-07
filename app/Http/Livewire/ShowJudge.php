<?php

namespace App\Http\Livewire;

use App\Models\Judge;
use App\Models\User;
use http\Env\Request;
use Livewire\Component;

class ShowJudge extends Component
{

    public $show, $name, $username, $password;

    public function render()
    {

        $this->show = User::find(auth()->user()->id)->judge;
        return view('livewire.show-judge');

    }

    protected $listeners = [
        'deleteJudge' => 'destroy'
    ];

    public function destroy($id){
        try {
            Judge::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }

//    public function resetFields(){
//        $this->name = '';
//        $this->username = '';
//        $this->password = '';
//        $this->password_confirmation = '';
//        $this->user_type = '';
//    }

//    public function store(){
//
//        // Validate Form Request
//       // $this->validate();
//
//            // Create Post
//            User::create([
//                'name'=>$this->name,
//                'username'=>$this->username,
//                'password'=>$this->password,
//                'user_type'=>$this->user_type
//            ]);
//
//            // Set Flash Message
//            session()->flash('success','Post Created Successfully!!');
//
//            // Reset Form Fields After Creating Post
//            $this->resetFields();
//        }
////        catch(\Exception $e){
////            // Set Flash Message
////            session()->flash('error','Something goes wrong while creating post!!');
////
////            // Reset Form Fields After Creating Post
////            $this->resetFields();
////        }





}
