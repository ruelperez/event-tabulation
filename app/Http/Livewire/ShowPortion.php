<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowPortion extends Component
{
    public $show, $title, $user_id, $event_id;
    public $show_cri, $show_portion, $title_cri, $percentage_cri, $portion_id, $criID;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->show_cri = User::find(auth()->user()->id)->criteria;
        $this->show_portion = User::find(auth()->user()->id)->portion;

        $this->eventID();
        $this->user_id = auth()->user()->id;
        $this->show = User::find(auth()->user()->id)->portion;
        return view('livewire.show-portion');
    }

    public function updated($field){
        $this->validateOnly($field, [
            'percentage_cri' => 'integer'
        ]);
    }

    public function submit_cri(){
        $this->validate([
            'portion_id' => 'required|integer',
            'title_cri' => 'required',
            'percentage_cri' => 'required|integer'
        ]);

        try {
            Criteria::create([
                'portion_id' => $this->portion_id,
                'user_id' => $this->user_id,
                'title' => $this->title_cri,
                'percentage' => $this->percentage_cri,
            ]);

            $this->percentage_cri = "";
            $this->title_cri = "";
            session()->flash('criteriaSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Register");
        }


    }

    public function eventID(){
        $datas = User::find(auth()->user()->id)->event;
        if (count($datas) == 0){
            $this->event_id = null;
        }
        else{
            foreach ($datas as $data){
                $this->event_id = $data->id;
            }
        }

    }

    public function submit(){
        $prtn = User::find(auth()->user()->id)->event;
        if (count($prtn) == "0"){
            $this->title = "";
            session()->flash('portionError','Failed! (Register first an Event Title)');
            return;
        };
        $this->validate(['title' => 'required']);
        try {
            Portion::create([
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'title' => $this->title,
            ]);
            $this->title = "";
            session()->flash('portionSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('portionError',"Failed to Register");
        }


    }

    protected $listeners = [
        'deleteTitles' => 'destroy',
        'deleteCriteria' => 'destroyCri'
    ];

    public function destroy($id){
        try {
            Portion::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }

    public function destroyCri($id){
        try {
            Criteria::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }
        catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting!!");
        }
    }

    public function table($id){
        $this->portion_id = $id;
    }

    public function delete_cri($id){
        Criteria::find($id)->delete();
    }

    public function edit_cri($id,$ids){
        $this->criID = $id;
        $cri = Criteria::find($id);
        $this->title_cri = $cri->title;
        $this->percentage_cri = $cri->percentage;
        $this->portion_id = $ids;
    }

    public function submit_editCri(){
        $this->validate(['title_cri' => 'required']);
        $cri = Criteria::find($this->criID);

        try {
            $cri->title = $this->title_cri;
            $cri->percentage = $this->percentage_cri;
            $cri->portion_id = $this->portion_id;
            $cri->percentage = $this->percentage_cri;
            $cri->save();
            $this->title_cri = "";
            $this->percentage_cri = "";
            session()->flash('criteriaSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Register");
        }
    }
}
