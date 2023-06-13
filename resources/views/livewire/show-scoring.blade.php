<div>
{{--    <button type="button" class="btn btn-primary" id="btnID" data-bs-toggle="modal" data-bs-target="#btnModal" hidden>--}}
{{--        Launch demo modal--}}
{{--    </button>--}}

{{--@include('components.score_submit_modal')--}}
<div class="d-flex container-fluid" style="margin-top: 10px;" >
    <div style="width: 50%;">

        <img src="{{ asset('storage/'.$event->photo) }}" width="100%"/>

        <table style="margin-top: 40px;">
            <tr >
                <td>
                    <img src="{{ asset('storage/'.$judge_profile->photo) }}" width="130" style="border-radius: 50%;">
                </td>
                <td >
                    <h3 style="margin-left: 10px;">Judge #{{$judge_profile->judge_number}}</h3>
                    <h5 style="margin-left: 10px;">{{ucwords($judge_profile->full_name)}}</h5>
                    <form action="/judge/logout" method="POST">
                        @csrf
                        <button style="border: none; background-color: white; color: blue; margin-left: 10px;">Logout</button>
                    </form>
                </td>
            </tr>
        </table>

        <ul class="list-group" style="width: 100%; margin-top: 40px;" >
            @php $vp = 1; $sp = 1; @endphp
            @foreach($portion as $portions)
                @php $juy=0; @endphp
                <li wire:ignore.self class="list-group-item btn" style=" @if($portions->event_id == $IDevent) @else display: none; @endif background-color: @if($sp == 1) aquamarine @else none @endif ; @for($tg=0; $tg<count($alas); $tg++) @if($alas[$tg] == $portions->id) @php $juy++; @endphp @endif @endfor @if($juy > 0) display: none;  @endif" id="style{{$sp}}" wire:click="ptnClick({{$portions->id}})" onclick="portionFetch({{$sp++}})">
                    {{ucwords($portions->title)}}
                </li>
                <input type="text" value="{{$vp++}}"  hidden>
            @endforeach
            <input type="text" id="porMax" value="{{$vp-1}}" hidden>
        </ul>

    </div>

    @php $r=1; $l=1; $jk=1; $jas=0; $dp=0; $dos = 0; $jd = 0; @endphp
    @foreach($portion as $portions)

    <form wire:ignore.self id="formFetch{{$r}}" style="margin-left: 20px;display: @if($r == 1) block @else none  @endif ">
        @csrf
        <table class="table table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th colspan="3" style="text-align: center; padding-bottom: 18px; font-size: 25px;">{{ucwords($portions->title)}}</th>
                @foreach($criteria as $criterias)
                    @if($criterias->portion_id == $portions->id)
                    <th style="text-align: center; width: 500px;" >{{ucwords($criterias->title)}}  ({{($criterias->percentage)}}%)</th>
                    @endif
                @endforeach
                <th style="text-align: center; width: 13%;">Total <br> {{$min}}-{{$max}}</th>
            </tr>
            </thead>
            <tbody>
                @if($portions->numberOfCandidateToRate > 0)
                    @if($rank != null )
                        @if(isset($rank))
                            @foreach($litop[$dp] as $candidates)
                                    <tr>
                                        <th style="text-align: center; width: 200px; font-size: 20px; padding-top: 23px;" id="we">{{$candidates->candidate_number}}</th>
                                        <td><img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70"/></td>
                                        <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p></td>
                                        @php $qp = 1; @endphp
                                        @foreach($criteria as $criterias)
                                            @if($criterias->portion_id == $portions->id)
                                                <input type="text" hidden value="{{$judge_profile->id}}" name="judge_id">
                                                <input type="text" hidden id="portionID{{$x}}" value="{{$portions->id}}" name="portion_id[{{$x}}]">
                                                <input type="text" hidden id="candidateID{{$x}}"  value="{{$candidates->candidate_number}}" name="candidate_number[{{$x}}]">
                                                <input type="text" hidden id="criteriaID{{$x}}" value="{{$criterias->id}}" name="criteria_id[{{$x}}]">
                                                <input type="text" hidden id="percent{{$x}}" value="{{"0.".$criterias->percentage}}">
                                                <input type="text" hidden id="ans{{$x}}" value="{{$jk}}">
                                                <td><input type="text"  @if(isset($rtt[$x])) value="{{$rtt[$x]}}" @endif  @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled @endif class="form-control" id="scoreID{{$x}}" name="rating[{{$x}}]" onchange="onBlur({{$x++}},{{$jk}})" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                                            @endif
                                        @endforeach
                                        <td><input type="text" onchange="totalValue({{$jk}},{{$x-=1}})" @if(isset($total_data[$jk])) value="{{$total_data[$jk]}}" @endif class="form-control" id="total{{$jk}}" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled  @endif  @if($iy == 1) disabled @endif></td>
                                        @php $x++; $jk=$x @endphp

                                        <input type="text" hidden value="{{$z++}}">
                                        <input type="text" hidden value="{{$u=1}}">
                                    </tr>
                            @endforeach
                            @php $jas++; $dp++; @endphp
                        @endif
                    @else
                        @php $cnt = 1; @endphp
                        @foreach($candidate as $candidates)
                            @if($cnt <= $portions->numberOfCandidateToRate)
                                <tr>
                                    <th style="text-align: center; width: 200px; font-size: 20px; padding-top: 23px;" id="we">{{$candidates->candidate_number}}</th>
                                    <td><img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70"/></td>
                                    <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p></td>
                                    @php $qp = 1; @endphp
                                    @foreach($criteria as $criterias)
                                        @if($criterias->portion_id == $portions->id)
                                            <input type="text" hidden value="{{$judge_profile->id}}" name="judge_id">
                                            <input type="text" hidden id="portionID{{$x}}" value="{{$portions->id}}" name="portion_id[{{$x}}]">
                                            <input type="text" hidden id="candidateID{{$x}}" value="{{$candidates->candidate_number}}" name="candidate_number[{{$x}}]">
                                            <input type="text" hidden id="criteriaID{{$x}}" value="{{$criterias->id}}" name="criteria_id[{{$x}}]">
                                            <input type="text" hidden id="percent{{$x}}" value="{{"0.".$criterias->percentage}}">
                                            <input type="text" hidden id="ans{{$x}}" value="{{$jk}}">
                                            <td><input type="text"  @if(isset($rtt[$x])) value="{{$rtt[$x]}}" @endif  @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled @endif class="form-control" id="scoreID{{$x}}" name="rating[{{$x}}]" onchange="onBlur({{$x++}},{{$jk}})" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                                        @endif
                                    @endforeach
                                    <td><input type="text" onchange="totalValue({{$jk}},{{$x-=1}})" @if(isset($total_data[$jk])) value="{{$total_data[$jk]}}" @endif class="form-control" id="total{{$jk}}" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled  @endif  @if($iy == 1) disabled @endif></td>
                                    @php $x++; $jk=$x @endphp

                                    <input type="text" hidden value="{{$z++}}">
                                    <input type="text" hidden value="{{$u=1}}">
                                </tr>
                                @php $cnt++; @endphp

                            @endif
                        @endforeach
                    @endif
                @else
                    @foreach($candidate as $candidates)
                        @php $jd=0; @endphp
                        <tr>
                            <th style="text-align: center; width: 200px; font-size: 20px; padding-top: 23px;" id="we">{{$candidates->candidate_number}}</th>
                            <td><img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70"/></td>
                            <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p></td>
                            @php $qp = 1; @endphp
                            @foreach($criteria as $criterias)
                                @if($criterias->portion_id == $portions->id)
                                    <input type="text" hidden value="{{$judge_profile->id}}" name="judge_id">
                                    <input type="text" hidden id="portionID{{$x}}" value="{{$portions->id}}" name="portion_id[{{$x}}]">
                                    <input type="text" hidden id="candidateID{{$x}}" value="{{$candidates->candidate_number}}" name="candidate_number[{{$x}}]">
                                    <input type="text" hidden id="criteriaID{{$x}}" value="{{$criterias->id}}" name="criteria_id[{{$x}}]">
                                    <input type="text" hidden id="percent{{$x}}" value="{{$criterias->percentage}}">
                                    <input type="text" hidden id="ans{{$x}}" value="{{$jk}}">
                                    <td><input type="text" @if($iy == 1) disabled @endif   @if(isset($rtt[$x])) value="{{$rtt[$x]}}" @endif  @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled @endif class="form-control" id="scoreID{{$x}}" name="rating[{{$x}}]" onchange="onBlur({{$x++}},{{$jk}})" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                                    @php $jd++; @endphp
                                @endif
                            @endforeach
                                <td><input type="text" onchange="totalValue({{$jk}},{{$x-=1}})" @if(isset($total_data[$jk])) value="{{$total_data[$jk]}}" @endif class="form-control" id="total{{$jk}}" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" @if(isset($islocked[$x]) and $islocked[$x] == 1 ) disabled  @endif  @if($iy == 1) disabled @endif></td>
                                @php $x++; $jk=$x; @endphp

                                <input type="text" hidden value="{{$z++}}">
                                <input type="text" hidden value="{{$u=1}}">
                        </tr>
                        @php $dos++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <input type="text" value="{{$dos}}" id="totalcan" hidden>
        <input type="text" value="{{$jd}}" id="totalcri" hidden>

        <div @if(isset($islocked[$x-=1]) and $islocked[$x] == 1 ) @else onclick="filterForm({{$l}},{{$x}})"  @endif  style="text-align:center; @if(isset($islocked[$x]) and $islocked[$x] == 1 ) @else cursor: pointer;  @endif  padding: 5px; width: 60%; height: 40px; margin-left: 20%; background-color: aquamarine"><b>Submit</b></div>

        <button type="button" class="btn btn-primary" id="btnID{{$x}}" data-bs-toggle="modal" data-bs-target="#btnModal{{$x}}" hidden>
            Launch demo modal
        </button>

        @include('components.score_submit_modal')
    </form>
    @php $r++; $l = $x+1; $x++; @endphp

    @endforeach

    <input type="text" id="maxX" value="{{$x-1}}" hidden>
    <input type="text" id="maxCan" value="{{$z-1}}" hidden>
    <input type="text" id="min_rate" value="{{$min}}" hidden>
    <input type="text" id="max_rate" value="{{$max}}" hidden>
    </div>

{{--    @livewire('show-result')--}}

    <script>
        function totalValue(start,end){
            let as = $("#total"+start).val();
            let s = $("#total"+start);

            for (let b=start; b <= end; b++){
               let val = $("#scoreID"+b);
               let re = 0;
               val.val(re);
               let ds =  $("#percent"+b);
                val.val(ds.val() * as / 100);
            }

            //Update Data
            let max = $("#maxX").val();
            let rating = [];
            let candi = [];
            let criteria = [];
            let portion = [];

            for (let ix=1; ix <= max; ix++){
                let a = $("#candidateID"+ix).val();
                let c = $("#portionID"+ix).val();
                let b = $("#criteriaID"+ix).val();
                let fa = $("#scoreID"+ix).val();

                rating[ix] = fa;
                candi[ix] = a;
                criteria[ix] = b;
                portion[ix] = c;

            }

            window.livewire.emit('rateEmit', rating,candi,criteria,portion);

        }

        function exitModal(){
            window.livewire.emit('exit');
        }

        function filterForm(start,end){
            let uss = $("#totalcan").val();
            let zss = $("#totalcri").val();
            let h = 1;
            let wed = 1;
            let weds = 0;
            let oas = [];
            let tot = $("#total"+end);
            for (let i=start; i <= end; i++){
                let u  = $("#scoreID"+i).val();
                if (u == 0){
                    h++;
                }
            }
            for (let je=1; je <= uss; je++){
                for (let jer=1; jer <= zss; jer++){
                    wed++;
                    if (jer == 1){
                        wed--;
                        oas[je] = wed;
                        wed++;
                    }

                }
            }

            for (let oo=1; oo <=  oas.length; oo++){
                let tot = $("#total"+oas[oo]).val();
                if (tot < 75){
                    alert('THE TOTAL SCORE IN INVALID, MINIMUM IS 75');
                    return;
                }
                else if(tot > 100){
                    alert('THE TOTAL SCORE IN INVALID, MAXIMUM IS 100');
                    return;
                }

            }
            if (h >= 2){
                alert('PLEASE RATE ALL THE CANDIDATE');
                return;
            }
            else if (tot.val() > 100){

            }
            else if (h == 1){
                let yt = $("#btnID"+end).click();

            }

        }

        function onFocus(num,candidate) {
            let total = document.getElementById("total"+candidate).value;
            let tot = document.getElementById("total"+candidate);
            let percentage = document.getElementById("percent"+num).value;
            let rateVal = document.getElementById("scoreID"+num).value;
            let rate = document.getElementById("scoreID"+num).value;
            let minr = document.getElementById("min_rate").value;
            let maxr = document.getElementById("max_rate").value;

            if (rate != 0){
                rateVal *= percentage;
                rate = Number(total) - Number(rateVal);
                tot.value = rate;
                return;
                // onBlur();

            }
            else{

                return;
            }

            let product = document.getElementById("total"+candidate).value;
            var i = document.getElementById("scoreID"+num);

            if (rate > Number(maxr)){
                rate = Number(maxr);
                i.value = rate;
            }
            else if (rate < Number(minr)){
                rate = Number(minr);
                i.value = rate;
            }
            let compute = rate * percentage;
            let final = Number(product) + Number(compute);
            total.value = final;
        }

        function onBlur(num,candidate){

            let score = $("#scoreID"+num).val();
            let total = $("#total"+candidate).val();
            let maxr = $("#percent"+num).val();
            let rate = $("#scoreID"+num);
            if (Number(score) > Number(maxr)){
                rate.val(maxr);
            }
            else{
                rate.val(score);
            }

            let fin = total + rate;

            total += fin;

            // myFunction();
            // updateData
            let max = $("#maxX").val();
            let rating = [];
            let candi = [];
            let criteria = [];
            let portion = [];

            for (let ix=1; ix <= max; ix++){
                let a = $("#candidateID"+ix).val();
                let c = $("#portionID"+ix).val();
                let b = $("#criteriaID"+ix).val();
                let fa = $("#scoreID"+ix).val();

                rating[ix] = fa;
                candi[ix] = a;
                criteria[ix] = b;
                portion[ix] = c;

            }

            window.livewire.emit('rateEmit', rating,candi,criteria,portion);


        }

        function portionFetch(id){

            let porMax = document.getElementById("porMax").value;
            let ff = document.getElementById("formFetch"+id);
            let style = document.getElementById("style"+id);
            for (let t = 1; t <= porMax; t++){
                document.getElementById("formFetch"+t).style.display = "none";
                document.getElementById("style"+t).style.backgroundColor = "";
            }
            style.style.backgroundColor = "aquamarine";
            ff.style.display = "block";

            window.livewire.emit('exit');
        }

        function myFunction(){
            let ert = document.getElementById("scoreID1").value;
            let max = document.getElementById("maxX").value;
            let rating = [];
            let candidate = [];
            let criteria = [];
            let portion = [];

            for (let i=1; i <= max; i++){
                let a = document.getElementById("candidateID"+i).value;
                let c = document.getElementById("portionID"+i).value;
                let b = document.getElementById("criteriaID"+i).value;
                let f = document.getElementById("scoreID"+i).value;
                let t = document.getElementById("scoreID"+i);

                if (f == "" || f == 0){
                    t.value = 0;
                    rating[i] = 0;
                }
                else if (f != 0){
                    rating[i] = f;
                }
                portion[i] = c;
                candidate[i] = a;
                criteria[i] = b;

            }

            window.livewire.emit('rateEmit', rating,candidate,criteria,portion);

        }


    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input').click(function() {
                $(this).select();
            });
        });
    </script>
</div>



