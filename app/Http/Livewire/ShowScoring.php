<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Event;
use App\Models\Extra_toplist;
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
    public $event, $IDevent, $vt=1, $judge_profile, $try,$candidate, $min, $max, $portion, $litop, $criteria, $ids = 1, $judge_id, $candidate_id = [], $tot, $total_data, $limit, $rmm, $bbm = 0, $islocked=[], $iy=0, $linkInput=[], $rank,
            $criteria_id = [], $rtg, $rating=[], $x=1, $total=[], $pass, $num=1, $ber=1, $r, $datas, $u=1, $z=1, $rtt=[], $xa = 1, $sa = 0, $rateData, $submitted=0, $tns, $alas = [], $linkID =[];

    public function render()
    {
        $dds = \App\Models\MinMaxRating::where('event_id',$this->IDevent)->get();
        foreach ($dds as $ds){
            $this->min = $ds->min;
            $this->max = $ds->max;
        }
        $this->judge_profile = Auth::guard('webjudge')->user();
        $this->judge_id = Auth::guard('webjudge')->user()->id;
        $auth = Auth::guard('webjudge')->user()->user_id;
        $this->event = Event::find($this->IDevent);
        $this->candidate = Event::find($this->IDevent)->candidate;
        $this->portion = Event::find($this->IDevent)->portion;
        $this->criteria = User::find($auth)->criteria;
        $sed = DB::table('ratings')
            ->where('event_id', $this->IDevent)
            ->where('judge_id', $this->judge_id)
            ->get();
        $drd = User::find($auth)->criteria;
        $this->rtg = DB::table('ratings')
            ->where('event_id', $this->IDevent)
            ->where('judge_id', $this->judge_id)
            ->get();
        $ca = User::find($auth)->criteria;
        foreach ($drd as $drds){
            if ($drds->isLink == 1){
                $this->alas[] = $drds->portion_id;
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

    public function mount($eventID){
        $this->IDevent = $eventID;
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
        $rt = Rating::where('event_id', $this->IDevent)
                    ->where('judge_id', $this->judge_id)
                    ->get();

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
                    'event_id' => $this->IDevent,
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
               $rts->event_id = $this->IDevent;
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
                            if ($rngs->event_id == $this->IDevent and $rngs->judge_id == $jdg and $rngs->portion_id == $pns->id and $rngs->candidate_number == $cans->candidate_number and $cria[$nm] == $rngs->criteria_id){
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
                    $cria = [];

                }

            }
        }

    }

    public function limit_candidate(){

        $auth = Auth::guard('webjudge')->user()->user_id;
        $jg = \App\Models\Assignment::where('event_id',$this->IDevent)->get();
        $rating = Rating::all();
        $ca = Event::find($this->IDevent)->criteria;
        $pn = Event::find($this->IDevent)->portion;
        $prt = Event::find($this->IDevent)->portion;
        $can = Event::find($this->IDevent)->candidate;
        $to = 0;
        $y = 0;
        $cn = 0;
        $prs = [];


        $countJudge = count($jg);

        foreach ($prt as $prts){

            if ($prts->numberOfTopCandidate > 0){
                $prs[] = $prts->id;
            }

            foreach ($can as $cans) {

                foreach ($pn as $pns){

                    if ($prts->id == $pns->id){

                        foreach ($jg as $jgs){

                            foreach ($ca as $cas) {

                                if ($cas->portion_id == $pns->id and $cas->isLink == 1) {

                                    foreach ($rating as $ratings) {
                                        if ($ratings->event_id == $this->IDevent and $ratings->criteria_id == $cas->id and $ratings->judge_id == $jgs->id and $ratings->candidate_number == $cans->candidate_number) {
                                            $tu = $ratings->rating * $cas->percentage / 100;
                                            $to += $tu;
                                            $ps = $pns->id;
                                            $y = 1;

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
                            $y=0;
                            $cn=1;
                        }


                    }

                }

            }

        }

        if ($cn == 1){

            $topDATA = Event::find($this->IDevent)->toplist;

            if (count($topDATA) != 0){
                $io = 0;
                foreach ($topDATA as $tplis){
                    $tplis->portion_id = $toppor[$io];
                    $tplis->candidate_id = $topcan[$io];
                    $tplis->result = $topList[$io];
                    $tplis->event_id = $this->IDevent;
                    $tplis->save();
                    $io++;
                }

            }
            else{
                for ($ha = 0; $ha<count($topcan); $ha++){
                    Toplist::create([
                        'portion_id' => $toppor[$ha],
                        'candidate_id' => $topcan[$ha],
                        'result' => $topList[$ha],
                        'event_id' => $this->IDevent,
                    ]);
                }
            }
            $list = DB::table('toplists')->orderBy('result','desc')->get();
            $qp = Event::find($this->IDevent)->toplist;

            foreach ($list as $lists){
                if ($this->IDevent == $lists->event_id){
                    $tpl_data[] = $lists->id;
                }
            }

            for ($nas=0; $nas<count($prs); $nas++){

                for ($mq=0; $mq<count($tpl_data); $mq++){
                    $tl = Toplist::find($tpl_data[$mq]);
                    if ($tl->portion_id == $prs[$nas]){
                        $top_list[$nas][] = $tl->id;
                    }
                }

            }

            for ($n = 0; $n<count($top_list); $n++){

                for ($tr=0; $tr<count($top_list[$n]); $tr++){

                    $rank_data[$n][$tr] = Toplist::find($top_list[$n][$tr])->candidate;
                }

            }

            $this->rank = $rank_data;



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
        $auth = Auth::guard('webjudge')->user()->user_id;
        $ca = User::find($auth)->criteria;
        $pn = Event::find($this->IDevent)->portion;
        $can = Event::find($this->IDevent)->candidate;
        $jm = [];
        $mh = [];
        $can_id = [];
        $can_num = [];
        $pr_id = [];
        $jm = [];

        $rr = DB::table('ratings')
            ->where('event_id', $this->IDevent)
            ->where('judge_id', $this->judge_id)
            ->get();

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
        $ge=0;
        $hr=0;
        foreach ($pn as $pns){

            if ($pns->numberOfCandidateToRate > 0){

                if ($this->rank != null){

                    $fq=0;
                    foreach ($this->rank[$ge] as $rnk){

                        if ($pns->numberOfCandidateToRate > $fq){
                            $can_id[] = $rnk->id;
                            $can_num[] = $rnk->candidate_number;
                            $pr_id[] = $pns->id;
                            $fq++;
                        }
                    }
                    $th = Portion::find($pns->id)->extra_toplist;

                    if (count($th) > 0){
                        $cv=0;
                       foreach ($th as $ths){
                           $ths->candidate_id = $can_id[$cv];
                           $ths->candidate_number = $can_num[$cv];
                           $ths->portion_id = $pr_id[$cv];
                           $ths->judge_id = Auth::guard('webjudge')->user()->id;
                           $ths->event_id = $this->IDevent;
                           $cv++;
                           $ths->save();
                       }

                    }
                    else{

                        for ($mn=0; $mn<count($can_id); $mn++){

                            Extra_toplist::create([
                                'portion_id' => $pr_id[$mn],
                                'event_id' => $this->IDevent,
                                'candidate_id' => $can_id[$mn],
                                'candidate_number' => $can_num[$mn],
                                'judge_id' => Auth::guard('webjudge')->user()->id,
                            ]);

                        }

                    }

                    $list = DB::table('extra_toplists')->orderBy('candidate_number','asc')->get();

                    foreach ($list as $lists){
                        if ($lists->portion_id == $pns->id){
                            $mh[] = $lists->candidate_id;
                        }
                    }

                    for ($mm=0; $mm<count($mh); $mm++){
                        $jm[$hr][] = Candidate::find($mh[$mm]);
                    }

                    $this->litop[$hr] = $jm[$hr];

                    foreach ($this->litop[$hr] as $cans){

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
                    $hr++;
                    $jm = [];
                    $mh = [];
                    $can_id = [];
                    $can_num = [];
                    $pr_id = [];
                    $ge++;

                }
                else{
                    $kk = 1;
                    foreach ($can as $cans){
                        if ($kk <= $pns->numberOfCandidateToRate){

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
            if ($ratings->judge_id == $auths and $ratings->event_id == $this->IDevent){
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
