<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Judge;
use App\Models\User;
use http\Env\Request;
use Livewire\Component;

class ShowJudge extends Component
{

    public $show, $user_id, $judge_number, $event_id, $full_name, $username, $password, $password_confirmation, $is_chairman, $photo;

    public function render()
    {
        $datas = User::find(auth()->user()->id)->event;
        foreach ($datas as $data){
            $this->event_id = $data->id;
        }
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->judge;

        return view('livewire.show-judge');

    }

    public function updated($field){
        $this->validateOnly($field, [
            'judge_number' => 'required|integer',
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);
    }


    public function submit(){
        $evnt = User::find(auth()->user()->id)->event;
        if (count($evnt) == "0"){
            $this->reset_form();
            session()->flash('regError','Failed! Register first an Event Title');
            return;
        };

        $active = User::find(auth()->user()->id)->judge;
        foreach ($active as $actives){
            if ($actives->id == $this->judge_number){
                session()->flash('regError', 'Input unique candidate number');
                return;
            }
        }
        $this->validate([
            'judge_number' => 'required|integer',
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($this->is_chairman == null || $this->is_chairman == false){
            $this->is_chairman = "0";
        }
        elseif ($this->is_chairman == true){
            $this->is_chairman = "1";
        }

        $this->password = bcrypt($this->password);

        try {
            Judge::create([
                'id' => $this->judge_number,
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
            session()->flash('data_unsave','Failed to Registered');
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
        $this->judge_number = "";
        $this->full_name = '';
        $this->username = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->is_chairman = '';
    }

}
