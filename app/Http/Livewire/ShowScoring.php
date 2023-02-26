<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Judge;
use App\Models\Portion;
use App\Models\Rating;
use App\Models\Toplist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowScoring extends Component
{
    public $event, $IDevent, $vt=1, $judge_profile, $try,$candidate, $portion, $criteria, $ids = 1, $judge_id, $candidate_id = [], $tot, $total_data, $rmm, $bbm = 0, $islocked=[], $iy=0, $linkInput=[], $rank,
            $criteria_id = [], $rtg, $rating=[], $x=1, $total=[], $pass, $num=1, $ber=1, $r, $datas, $u=1, $z=1, $rtt=[], $xa = 1, $sa = 0, $rateData, $submitted=0, $tns, $alas = 0, $linkID =[];

    public function render()
    {
        $this->IDevent = Judge::find(Auth::guard('webjudge')->user()->id)->event_id;
        $this->judge_profile = Auth::guard('webjudge')->user();
        $this->judge_id = Auth::guard('webjudge')->user();
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = User::find($auth)->event;
        $this->candidate = Event::find($this->IDevent)->candidate;
        $this->portion = Event::find($this->IDevent)->portion;
        $this->criteria = User::find($auth)->criteria;
        $sed = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        $drd = User::find($auth)->criteria;
        $this->rtg = Judge::find(Auth::guard('webjudge')->user()->id)->rating;
        $ca = User::find($auth)->criteria;
        foreach ($drd as $drds){
            if ($drds->isLink == 1){
                $this->alas = $drds->portion_id;
            }

        }
        if (count($sed) == 0){

        }
        else{
            $this->top();
            $this->limit_candidate();
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
        }


    }

    public function top(){

        $auth = Auth::guard('webjudge')->user()->user_id;
        $ca = User::find($auth)->criteria;
        $pn = Event::find($this->IDevent)->portion;
        $can = Event::find($this->IDevent)->candidate;
        $rst = 0;

        foreach ($pn as $pns){

            foreach ($can as $cans){

                foreach ($ca as $cas){

                    if ($cas->portion_id == $pns->id and $cas->isLink == 1){
                        $cria[] = $cas->id;
                        $rate = Portion::find($cas->portionLink)->rating;
                        $jdg = Auth::guard('webjudge')->user()->id;

                        foreach ($rate as $rates){
                            if ($rates->judge_id == $jdg and $rates->candidate_number == $cans->candidate_number){
                                $pct =  Criteria::find($rates->criteria_id)->percentage;
                                $rst += $rates->rating * $pct / 100;
                            }

                        }
                        $saved[] = $rst;
                    }
                    else{

                    }
                    $rst = 0;
                }
                if (isset($saved)){

                    for ( $nm = 0; $nm<count($saved); $nm++){

                        $rng = Rating::all();
                        foreach ($rng as $rngs){
                            if ($rngs->judge_id == $jdg and $rngs->portion_id == $pns->id and $rngs->candidate_number == $cans->candidate_number and $cria[$nm] == $rngs->criteria_id){
                                try {
                                    $rngs->rating = $saved[$nm];
                                    $rngs->save();
                                    break;
                                }
                                catch(\Exception $e){
                                    dd('failed to save');
                                    break;
                                }

                            }
                        }

                    }

                    $saved = [];

                }

            }
        }



    }

    public function limit_candidate(){

        $auth = Auth::guard('webjudge')->user()->user_id;
        $jg = User::find($auth)->judge;
        $rating = Rating::all();
        $ca = User::find($auth)->criteria;
        $pn = Event::find($this->IDevent)->portion;
        $can = Event::find($this->IDevent)->candidate;
        $allJudge = Judge::all();
        $nu = 0;
        $to = 0;
        $y = 0;

        foreach ($jg as $jgt){
            $rew[] = $jgt->id;
        }

        for ($yu = 0; $yu<count($rew); $yu++){
            $sed[] = Judge::find($rew[$yu])->rating;
        }

        $countJudge = count($jg);


        foreach ($can as $cans) {

            foreach ($pn as $pns){

                foreach ($jg as $jgs){

                    foreach ($ca as $cas) {

                        if ($cas->portion_id == $pns->id and $cas->isLink == 1) {

                            foreach ($rating as $ratings) {
                                if ($ratings->criteria_id == $cas->id and $ratings->judge_id == $jgs->id and $ratings->candidate_number == $cans->candidate_number) {
                                    $tu = $ratings->rating * $cas->percentage / 100;
                                    $to += $tu;
                                    $ps = $pns->id;
                                    $y = 1;

                                }
                            }

                        }

                    }

                }

            }
           if ($y == 1){
               $topList[] = $to / $countJudge;
               $topcan[] = $cans->id;
               $toppor[] = $ps;
               $to = 0;
           }

        }

        if ($y == 1){

            $tpli = Portion::find($toppor[0])->toplist;

            $kl = 0;
            for ($nh = 0; $nh<count($sed); $nh++){

                if (count($sed[$nh]) > 0){
                    $kl++;
                }

            }

            if ($kl >= count($jg)){
                $io = 0;
                foreach ($tpli as $tplis){
                    $tplis->portion_id = $toppor[$io];
                    $tplis->candidate_id = $topcan[$io];
                    $tplis->result = $topList[$io];
                    $tplis->save();
                    $io++;
                }

            }
            elseif (count($tpli) == 0) {

                for ($ha = 0; $ha<count($topcan); $ha++){
                    Toplist::create([
                        'portion_id' => $toppor[$ha],
                        'candidate_id' => $topcan[$ha],
                        'result' => $topList[$ha],
                    ]);
                }
            }
            else{

                $io = 0;
                foreach ($tpli as $tplis){
                    $tplis->portion_id = $toppor[$io];
                    $tplis->candidate_id = $topcan[$io];
                    $tplis->result = $topList[$io];
                    $tplis->save();
                    $io++;
                }

            }

            $list = DB::table('toplists')->orderBy('result','desc')->get();

            foreach ($list as $lists){
                $ran[] = $lists->id;
            }

            for ($n = 0; $n<count($ran); $n++){
                $rank_data[] = Toplist::find($ran[$n])->candidate;
            }
            $this->rank = $rank_data;
            //$this->lado++;

        }

    }


    public function displayScoreData(){
        $this->rmm = [];
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
        $auth = Auth::guard('webjudge')->user()->user_id;
        $ca = User::find($auth)->criteria;
        $pn = Event::find($this->IDevent)->portion;
        $can = Event::find($this->IDevent)->candidate;

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

        foreach ($ca as $cas){

            if ($cas->isLink == 1){
                $this->linkID[] = $cas->portionLink;
                $linkPercentage[] = $cas->percentage;
                $ptnId[] = $cas->portion_id;
            }
        }

        foreach ($pn as $pns){

            if ($pns->numberOfTopCandidate > 0){

                if (count($this->rank) != 0){
                    $kk = 1;
                    foreach ($this->rank as $cans){
                        if ($kk <= $pns->numberOfTopCandidate){

                            foreach ($ca as $cas){

                                if ($pns->id == $cas->portion_id){
                                    $this->sa = 1;
                                    $this->rmm[$re] *= $cas->percentage / 100;
                                    $equal += $this->rmm[$re];
                                    $re++;

                                }

                            }
                            $this->total_data[$dh] = $equal;
                            $equal = 0;
                            $dh = $re;
                            $kk++;
                        }

                    }

                }
                else{
                    $kk = 1;
                    foreach ($can as $cans){
                        if ($kk <= $pns->numberOfTopCandidate){

                            foreach ($ca as $cas){

                                if ($pns->id == $cas->portion_id){
                                    $this->sa = 1;
                                    $this->rmm[$re] *= $cas->percentage / 100;
                                    $equal += $this->rmm[$re];
                                    $re++;

                                }

                            }
                            $this->total_data[$dh] = $equal;
                            $equal = 0;
                            $dh = $re;
                            $kk++;

                        }

                    }

                }

            }
            else{
                foreach ($can as $cans){

                    foreach ($ca as $cas){

                        if ($pns->id == $cas->portion_id){
                            $this->sa = 1;
                            $this->rmm[$re] *= $cas->percentage / 100;
                            $equal += $this->rmm[$re];
                            $re++;

                        }

                    }
                    $this->total_data[$dh] = $equal;
                    $equal = 0;
                    $dh = $re;
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
