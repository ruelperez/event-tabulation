<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Judge;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;

class ShowJudge extends Component
{

    public $show, $image, $user_id, $judge_number, $event_id, $full_name, $username, $password, $password_confirmation, $is_chairman, $photo;

    public function mount($eventNUM){
        $this->event_id = $eventNUM;
    }


    public function render()
    {

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
        $jg = Event::find($this->event_id)->judge;
        if (count($jg) > 0){

            foreach ($jg as $jgs){
                if ($jgs->judge_number == $this->judge_number){
                    session()->flash('regError', 'Input unique candidate number');
                    return;
                }
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
        $image = $this->storeImage();
        try {
            Judge::create([
                'judge_number' => $this->judge_number,
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'full_name' => $this->full_name,
                'username' => $this->username,
                'password' => $this->password,
                'is_chairman' => $this->is_chairman,
                'photo' => $image,
            ]);
            $this->reset_form();
            session()->flash('data_save','Succsessfully Registered');
        }
        catch (\Exception $e){
            session()->flash('data_unsave','Failed to Registered');
        }

    }

    protected $listeners = [
        'deleteJudge' => 'destroy',
        'Upload' => 'handle',
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
        $this->image = '';
    }

    public function handle($imageData){
        $this->image = $imageData;
    }

    public function storeImage(){
        if (!$this->image) {
            return "null";
        }
        $img =  ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;

    }

}
