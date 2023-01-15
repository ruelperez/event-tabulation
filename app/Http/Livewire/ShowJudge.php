<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Judge;
use App\Models\User;
use http\Env\Request;
use Livewire\Component;

class ShowJudge extends Component
{

    public $show, $user_id, $event_id, $full_name, $username, $password, $password_confirmation, $is_chairman, $photo;

    public function render()
    {
        $datas = User::find(auth()->user()->id)->event;
        foreach ($datas as $data){
            $this->event_id = $data->id;
        }
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->judge;
//        dd(auth()->user()->id);
        return view('livewire.show-judge');

    }

    public function updated($field){
        $this->validateOnly($field, [
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);
    }


    public function submit(){
        $this->validate([
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($this->is_chairman == null){
            $this->is_chairman = "0";
        }

        $this->password = bcrypt($this->password);

        try {
            Judge::create([
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'full_name' => $this->full_name,
                'username' => $this->username,
                'password' => $this->password,
                'is_chairman' => $this->is_chairman,
            ]);
            $this->reset_form();
            session()->flash('data_save','Succsessfully Registered');
        }
        catch (\Exception $e){
            session()->flash('data_unsave','Succsessfully Registered');
        }

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

    public function reset_form(){
        $this->full_name = '';
        $this->username = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->is_chairman = '';
    }

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
