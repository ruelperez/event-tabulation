<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Judge;
use App\Models\Portion;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $vt=1, $judge_profile, $try,$candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [], $tot, $total_data, $rmm, $bbm = 0, $islocked=[], $iy=0, $linkInput=[],
            $criteria_id = [], $rtg, $rating=[], $x=1, $total=[], $pass, $num=1, $ber=1, $r, $datas, $u=1, $z=1, $rtt=[], $xa = 1, $sa = 0, $rateData, $submitted=0, $tns, $alas = 0, $linkID =[];

    public function render()
    {
        $this->judge_profile = Auth::guard('webjudge')->user();
        $this->judge_id = Auth::guard('webjudge')->user();
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = User::find($auth)->candidate;
        $this->portion = User::find($auth)->portion;
        $this->criteria = User::find($auth)->criteria;
        $sed = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        $drd = User::find($auth)->criteria;
        $this->rtg = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        foreach ($drd as $drds){
            if ($drds->isLink == 1){
                $this->alas = $drds->portion_id;
            }

        }
        if (count($sed) == 0){

        }else{
            $this->displayScoreData();
        }




        return view('livewire.show-scoring');
    }

    public function submit(){
        $u = count($this->criteria);
        $e = 1;
        for ($i=1; $i<=count($this->candidate); $i++){

            while ($e <= $u){
                Rating::create([
                    'judge_id' => $this->judge_id,
                    'candidate_id' => $this->candidate_id[$i][$e],
                    'criteria_id' => $this->criteria_id[$i][$e],
                    'rating' => $this->rating[$i][$e],
                ]);
                $e++;
            }
            $u += count($this->criteria);
        }
    }

    public function fetch($id){
        $this->ids = $id;
        $this->rating = [];
    }

    public function select($id){
        $this->num = $id;
    }

    public function getData($id){
        $this->pass = $id;
        $this->num = 2;
        $this->ber = 2;
    }

    protected $listeners = [
        'emitScore' => 'dataScore',
        'rateEmit' => 'scoreRate',
        'exit' => 'closeModal',
    ];

    public function scoreRate($rating,$candidate,$criteria,$portion){
//        dd($rating);
        $judgeID = Auth::guard('webjudge')->user()->id;
        $count = count($rating)-1;
        $rt = Judge::find($judgeID)->rating;
        $y = 1;

        $e = 1;

        foreach ($rt as $rts){
           $e = 0;
            break;
        }

        if ($e == 1){

            for ($i = 1; $i <= $count; $i++){

                Rating::create([
                    'judge_id' => $judgeID,
                    'rating' => $rating[$i],
                    'candidate_number' => $candidate[$i],
                    'criteria_id' => $criteria[$i],
                    'portion_id' => $portion[$i],
                ]);

                $this->emit('refreshResult');
            }

        }
        elseif ($e == 0){

            foreach ($rt as $rts){
               $rts->judge_id = $judgeID;
                $rts->portion_id = $portion[$y];
               $rts->rating = $rating[$y];
               $rts->candidate_number = $candidate[$y];
               $rts->criteria_id = $criteria[$y];
               $rts->save();
                $y++;
            }
            $this->emit('refreshResult');
        }

        $this->displayScoreData();





//        foreach ($rr as $rrs){
//            $this->xa = 1;
//            $this->rtt[$er] = $rrs->rating;
//            $er++;
//        }

//        if ($trax != 0){
//            foreach ($rt as $rts){
//               $rts->judge_id = $judgeID;
//               $rts->rating = $rating[$y];
//               $rts->candidate_number = $candidate[$y];
//               $rts->criteria_id = $criteria[$y];
//               $y++;
//               $rt->save();
//            }
//
//        }
//        else{
//            for ($i = 1; $i <= $count; $i++){
//
//                Rating::create([
//                    'judge_id' => $judgeID,
//                    'rating' => $rating[$i],
//                    'candidate_number' => $candidate[$i],
//                    'criteria_id' => $criteria[$i],
//                ]);
//            }
//        }


    }

    public function displayScoreData(){
        $hyp = 1;
        $ugh = 1;
        $urt = 0;
        $er = 1;
        $re = 1;
        $equal = 0;
        $dh = 1;
        $ram = 1;
        $gad = 1;
        $rr = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        $pn = $this->portion;
        $ca = $this->criteria;
        $can = $this->candidate;

        foreach ($rr as $rrs){
            $this->xa = 1;
            $this->rtt[$er] = $rrs->rating;
            $this->islocked[$er] = $rrs->isSubmit;
            $er++;
        }

        foreach ($rr as $rrs){
            $this->rmm[$ram] = $rrs->rating;
            $ram++;
        }


        foreach ($pn as $pns){

            foreach ($can as $cans){

                foreach ($ca as $cas){

                    if ($pns->id == $cas->portion_id){

                        $this->sa = 1;
                        $this->rmm[$re] *= '.'.$cas->percentage;
                        $equal += $this->rmm[$re];
                        $re++;

                    }
                }

                $this->total_data[$dh] = $equal;
                $equal = 0;
                $dh = $re;
            }


        }



        foreach ($ca as $cas){

            if ($cas->isLink == 1){
                $this->linkID[] = $cas->portionLink;
                $linkPercentage[] = $cas->percentage;
                $ptnId[] = $cas->portion_id;
            }
        }

       $qr = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        $rex = 0;

        foreach ($pn as $pns){

            foreach ($ca as $cas){

                if ($cas->isLink ==1 and $pns->id == $cas->portion_id){

                    foreach ($can as $cans) {

                        foreach ($qr as $qrs) {

                            if ($qrs->portion_id == $cas->portionLink and $qrs->candidate_number == $cans->candidate_number) {
                                $urt += $qrs->rating;
                                $gad++;
                            }

                        }
                        $gad--;
                        $this->linkInput[$hyp][$ugh] = $urt / $gad;
                        $urt = 0;
                        $gad = 1;
                        $hyp++;

                    }

                    $ugh++;
                    $hyp = 1;

                }
                else{

                }


            }

        }


    }

    public function dataScore($data,$x){
    $this->r = $x;
    $this->datas = $data;
    }

    public function submitModal($id,$auths){
        $rating = Rating::all();
        foreach ($rating as $ratings){
            if ($ratings->judge_id == $auths){
                if ($ratings->portion_id == $id){
                    $ratings->isSubmit = 1;
                    $ratings->save();
                }
            }
        }
        $this->bbm = 1;
    }

    public function closeModal(){

        $this->bbm = 0;
    }

    public function ptnClick($id){
        $this->submitted = 0;
        $this->tns = $id;
       $fs = Portion::find($id)->criteria;
       foreach ($fs as $fss){
           if ($fss->isLink == 1){
               $this->iy = 1;
               $porID_link[] = $fss->portionLink;
           }

       }
       if (isset($porID_link)){

           for ($f = 0; $f<count($porID_link); $f++){
               $pt = Portion::find($porID_link[$f])->rating;
               foreach ($pt as $pts){
                   if ($pts->judge_id == Auth::guard('webjudge')->user()->id and $pts->isSubmit == 5){
                       $this->submitted++;
                       break;
                   }

               }

           }
           if (count($porID_link) == $this->submitted){
               $this->iy =0;
           }


       }
       else{
           $this->iy=0;
       }






    }




}
