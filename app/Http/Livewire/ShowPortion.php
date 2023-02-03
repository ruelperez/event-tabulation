<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowPortion extends Component
{
    public $show, $title, $user_id, $event_id, $porID, $bb =1, $dd, $checkbox, $numberOfTopCandidate,
            $show_cri, $show_portion, $title_cri, $percentage_cri, $portionID_selectInput, $portion_id, $criID;

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
                'isLink' => false,
                'portionLink' => 0,
            ]);

            $this->percentage_cri = "";
            $this->title_cri = "";
            session()->flash('criteriaSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Register");
        }


    }

    public function submit_linkPortion(){
        $portion_selectInput = Portion::find($this->portionID_selectInput);
        $this->validate([
            'user_id' => 'required',
            'portion_id' => 'required',
            'portionID_selectInput' => 'required',
            'percentage_cri' => 'required|integer',
        ]);

        try {
            Criteria::create([
                'portion_id' => $this->portion_id,
                'user_id' => $this->user_id,
                'title' => $portion_selectInput->title,
                'percentage' => $this->percentage_cri,
                'isLink' => true,
                'portionLink' => $portion_selectInput->id,
            ]);

            $this->percentage_cri = "";
            $this->portionID_selectInput = "";
            session()->flash('linkSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('linkUnsave',"Failed to Register");
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
        if ($this->numberOfTopCandidate == null){
            $this->numberOfTopCandidate = 0;
        }
        $prtn = User::find(auth()->user()->id)->event;
        if (count($prtn) == "0"){
            $this->title = "";
            session()->flash('portionError','Failed! (Register first an Event Title)');
            return;
        };

        $this->validate([
        'event_id' => 'required',
        'user_id' => 'required',
        'title' => 'required',
        'numberOfTopCandidate' => 'required|integer'
        ]);

        try {

            Portion::create([
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'title' => $this->title,
                'numberOfTopCandidate' => $this->numberOfTopCandidate,
            ]);
            $this->title = "";
            $this->numberOfTopCandidate = "";
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
        $delP = Portion::find($id)->criteria;
        try {
            foreach ($delP as $delPs){
                Criteria::find($delPs->id)->delete();
            }
            //$delP->delete();
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
            session()->flash('criteriaSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Register");
        }
    }

    public function edit_por($id){
        $por = Portion::find($id);
        $this->title = $por->title;
        $this->user_id = $por->user_id;
        $this->event_id = $por->event_id;
        $this->porID = $por->id;
        $this->numberOfTopCandidate = $por->numberOfTopCandidate;
    }

    public function submitEdit(){
        $this->validate([
            'event_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'numberOfTopCandidate' => 'integer',
        ]);

        try {
            $new = Portion::find($this->porID);
            $new->user_id = $this->user_id;
            $new->event_id = $this->event_id;
            $new->title = $this->title;
            if ($this->numberOfTopCandidate != 0){
                $new->numberOfTopCandidate = $this->numberOfTopCandidate;
            }
            $new->save();
            $this->title = "";
            $this->numberOfTopCandidate = "";
            session()->flash('portionSave',"Successfully Saved");
        }
        catch (\Exception $e){
            session()->flash('portionError',"Failed to Saved");
        }

    }

    public function linkportionClicked($id){
        $this->dd = $id;
        $this->bb = $id;
    }

    public  function inputCriteria(){
        $this->bb = 0;
        $this->dd = 0;
    }

    public function submit_portion_edit(){

    }
}
