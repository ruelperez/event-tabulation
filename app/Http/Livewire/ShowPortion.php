<?php

namespace App\Http\Livewire;

use App\Models\Criteria;
use App\Models\Portion;
use App\Models\User;
use Livewire\Component;

class ShowPortion extends Component
{
    public $show, $title, $user_id, $event_id, $porID, $bb =1, $dd, $checkbox, $numberOfTopCandidate, $imbeds, $checkTop, $numberOfCandidate,
            $show_cri, $show_portion, $title_cri, $percentage_cri, $portionID_selectInput, $portion_id, $criID;

    public function mount($eventNUM,$imbed){
        $this->event_id = $eventNUM;
        $this->imbeds = $imbed;
    }

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->show_cri = User::find(auth()->user()->id)->criteria;
        $this->show_portion = User::find(auth()->user()->id)->portion;
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
            'portion_id' => 'required',
            'title_cri' => 'required',
            'percentage_cri' => 'required|integer',
            'event_id' => 'required',
        ]);

        try {
            Criteria::create([
                'portion_id' => $this->portion_id,
                'user_id' => $this->user_id,
                'title' => $this->title_cri,
                'percentage' => $this->percentage_cri,
                'isLink' => false,
                'portionLink' => 0,
                'event_id' => $this->event_id,
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
            'event_id' => 'required',
        ]);

        try {
            Criteria::create([
                'portion_id' => $this->portion_id,
                'user_id' => $this->user_id,
                'title' => $portion_selectInput->title,
                'percentage' => $this->percentage_cri,
                'isLink' => true,
                'portionLink' => $portion_selectInput->id,
                'event_id' => $this->event_id,
            ]);

            $this->percentage_cri = "";
            $this->portionID_selectInput = "";
            session()->flash('linkSave',"Successfully Registered");
        }
        catch (\Exception $e){
            session()->flash('linkUnsave',"Failed to Register");
        }

    }

    public function submit(){
        if ($this->numberOfTopCandidate == null){
            $this->numberOfTopCandidate = 0;
        }

        if ($this->numberOfCandidate == null){
            $this->numberOfCandidate = 0;
        }

        $this->validate([
        'event_id' => 'required',
        'user_id' => 'required',
        'title' => 'required',
        'numberOfTopCandidate' => 'required|integer',
        'numberOfCandidate' => 'required|integer',
        ]);

        try {

            Portion::create([
                'user_id' => $this->user_id,
                'event_id' => $this->event_id,
                'title' => $this->title,
                'numberOfTopCandidate' => $this->numberOfTopCandidate,
                'numberOfCandidateToRate' => $this->numberOfCandidate,
            ]);
            $this->title = "";
            $this->numberOfTopCandidate = "";
            $this->checkbox = "";
            $this->checkTop = "";
            $this->numberOfCandidate = "";
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
            $pn = Portion::find($id)->rating;
            foreach ($pn as $pns){
                $pns->delete();
            }
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
            $cri->portion_id = $this->portion_id;
            $cri->percentage = $this->percentage_cri;
            $cri->save();
            session()->flash('criteriaSave',"Successfully Modified");
            $this->percentage_cri = "";
            $this->title_cri = "";
        }
        catch (\Exception $e){
            session()->flash('criteriaUnsave',"Failed to Modify");
        }
    }

    public function edit_por($id){
        $por = Portion::find($id);
        $this->title = $por->title;
        $this->user_id = $por->user_id;
        $this->event_id = $por->event_id;
        $this->porID = $por->id;
        $this->numberOfTopCandidate = $por->numberOfTopCandidate;
        $this->numberOfCandidate = $por->numberOfCandidateToRate;
    }

    public function submitEdit(){
        $this->validate([
            'event_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'numberOfTopCandidate' => 'integer',
            'numberOfCandidate' => 'integer',
        ]);

        try {
            $new = Portion::find($this->porID);
            $new->user_id = $this->user_id;
            $new->event_id = $this->event_id;
            $new->title = $this->title;
            if ($this->numberOfTopCandidate != 0){
                $new->numberOfTopCandidate = $this->numberOfTopCandidate;
            }
            if ($this->numberOfCandidate != 0){
                $new->numberOfCandidateToRate = $this->numberOfCandidate;
            }
            $new->save();
            $this->title = "";
            $this->numberOfTopCandidate = "0";
            $this->numberOfCandidate = "0";
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

    public function close_m(){
        $this->portion_id = "";
        $this->title_cri = "";
        $this->percentage_cri = "";
    }
}
