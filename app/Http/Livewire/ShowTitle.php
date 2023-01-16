<?php

namespace App\Http\Livewire;


use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class ShowTitle extends Component
{
    public $show, $name, $user_id, $eventID;

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
        $evnt = User::find(auth()->user()->id)->event;
        if (count($evnt) >= "1"){
            $this->name = "";
            session()->flash('evntError',"Failed, Only one event is allowed, You can EDIT the data");
            return;
        }
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

    public function editTitle($id){
        $titleData = Event::find($id);
        $this->name = $titleData->title;
        $this->eventID = $titleData->id;
    }

    public function closeModal(){
        $this->name = "";
    }

    public function editSubmit(){
        $this->validate(['name' => 'required']);

        try {
            $new = Event::find($this->eventID);
            $new->title = $this->name;
            $new->save();
            $this->name = "";
            session()->flash('editSave',"Successfully Updated Data");
        }
        catch (\Exception $e){
            session()->flash('editError',"Something goes wrong while Editing!!");
        }


    }
}
