<?php

namespace App\Http\Livewire;


use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;

class ShowTitle extends Component
{
    public $show, $name, $user_id, $eventID, $image, $anti=1;

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

        $image = $this->storeImage();

        try {
            $new = Event::create([
                'title' => $this->name,
                'user_id' => $this->user_id,
                'photo' => $image,
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

    public function storeImage(){
        if (!$this->image) {
            return "null";
        }
        $img =  ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;

    }

    public function updated($field){
        $this->validateOnly($field, ['name' => 'required']);
    }

    protected $listeners = [
        'deleteTitle' => 'destroy',
        'files' => 'file',

    ];

    public function file($imageData){
        $this->image = $imageData;
        $this->anti++;
    }

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
        $this->image = $titleData->photo;
        $this->eventID = $titleData->id;
    }

    public function closeModal(){
        $this->name = "";
    }

    public function editSubmit(){
        $this->validate(['name' => 'required']);
        if ($this->anti != 1){
            $pic = $this->storeImage();
        }
        else{
            $pic = $this->image;
        }

        try {
            $new = Event::find($this->eventID);
            $new->title = $this->name;
            $new->photo = $pic;
            $new->save();
            $this->anti = 1;
            $this->name = "";
            $this->image = "";
            session()->flash('editSave',"Successfully Updated Data");
        }
        catch (\Exception $e){
            session()->flash('editError',"Something goes wrong while Editing!!");
        }


    }
}
