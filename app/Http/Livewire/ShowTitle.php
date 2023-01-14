<?php

namespace App\Http\Livewire;


use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class ShowTitle extends Component
{
    public $show, $name, $user_id;

    public function render()
    {
        $this->show = User::find(auth()->user()->id)->event;
        $this->user_id = auth()->user()->id;
        return view('livewire.show-title');
    }

//    public function mount(){

//        $this->show = User::find(auth()->user()->id)->event;
//        $this->user_id = auth()->user()->id;
//    }

    public function resetInput(){
        $this->name="";
    }

    public function submit(){

        $this->validate([
            'name' => 'required',
        ]);

        try {
            $new = Event::create([
                'title' => $this->name,
                'user_id' => $this->user_id
            ]);
            //$this->show->prepend($new);

        session()->flash('message', 'Added successfully');
        $this->resetInput();
            //$this->dispatchBrowserEvent('close-modal');
        }
        catch (\Exception $e){
            session()->flash('error',"Unable to register");
        }

    }

    public function updated($field){
        $this->validateOnly($field, ['name' => 'required']);
    }

    protected $listeners = [
        'deleteTitle' => 'destroy'
    ];

    public function destroy($id){
        try {
            Event::find($id)->delete();
            session()->flash('deleted',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('delete_error',"Something goes wrong while deleting!!");
        }
    }
}
