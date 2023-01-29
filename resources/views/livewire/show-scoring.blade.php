<div>

<div class="d-flex container-fluid" style="margin-top: 10px;">
    <div style="width: 50%;">
        @foreach($event as $events)
        <img src="{{ asset('storage/'.$events->photo) }}" width="100%"/>
        @endforeach
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

        <ul class="list-group" style="width: 100%; margin-top: 40px;">
            @php $vp = 1; $sp = 1; @endphp
            @foreach($portion as $portions)
                <li class="list-group-item btn" id="style{{$sp}}" onclick="portionFetch({{$sp++}})">
                    {{ucwords($portions->title)}}
                </li>
                <input type="text" value="{{$vp++}}"  hidden>
            @endforeach
            <input type="text" id="porMax" value="{{$vp-1}}" hidden>
        </ul>

    </div>

    @php $r=1; @endphp
    @foreach($portion as $portions)
    <form action="/rating/store" method="post" id="formFetch{{$r}}" style="margin-left: 20px;display: @if($r == 1) block @else none @endif ">
        @csrf
        <table class="table table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th colspan="3" style="text-align: center; padding-bottom: 18px; font-size: 25px;">{{ucwords($portions->title)}}</th>
                @foreach($criteria as $criterias)
                    @if($criterias->portion_id == $portions->id)
                    <th style="text-align: center; width: 500px;" >{{ucwords($criterias->title)}} <br> ({{($criterias->percentage)}}%)</th>
                    @endif
                @endforeach
                <th style="text-align: center; width: 13%;">Total</th>
            </tr>
            </thead>
            <tbody>

                @foreach($candidate as $candidates)
                    <tr>
                        <th style="text-align: center; width: 200px; font-size: 20px; padding-top: 23px;" id="we">{{$candidates->candidate_number}}</th>
                        <td><img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70"/></td>
                        <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p></td>
                        @foreach($criteria as $criterias)
                        @if($criterias->portion_id == $portions->id)
                            <input type="text" hidden value="{{$judge_id->id}}" name="judge_id">
                            <input type="text" hidden value="{{$candidates->candidate_number}}" name="candidate_number[{{$x}}]">
                            <input type="text" hidden value="{{$criterias->id}}" name="criteria_id[{{$x}}]">
                            <input type="text" hidden id="percent{{$x}}" value="{{"0.".$criterias->percentage}}">
                            <td><input type="text" class="form-control" id="scoreID{{$x}}" name="rating[{{$x}}]" onfocus="onFocus({{$x}},{{$candidates->candidate_number}})" onblur="onBlur({{$x++}},{{$candidates->candidate_number}})" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" required></td>
                        @endif
                        @endforeach
                            <td><input type="text" class="form-control" id="total{{$candidates->candidate_number}}"   style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                            <input type="text" hidden value="{{$z++}}">
                            <input type="text" hidden value="{{$u=1}}">
                    </tr>
                @endforeach
                <input type="text" id="maxX" value="{{$x-1}}" hidden>
                <input type="text" id="maxCan" value="{{$z-1}}" hidden>

            </tbody>
        </table>

        <button type="submit" class="btn btn-info" style="width: 40%; margin-left: 30%;">Submit</button>
    </form>
    @php $r++; @endphp
    @endforeach
    </div>
</div>

<script>
    function onFocus(num,candidate) {
        let total = document.getElementById("total"+candidate).value;
        let tot = document.getElementById("total"+candidate);
        let percentage = document.getElementById("percent"+num).value;
        let rateVal = document.getElementById("scoreID"+num).value;
        let rate = document.getElementById("scoreID"+num).value;
        if (rate != ""){
            console.log('haha');
            rateVal *= percentage;
           rate = Number(total) - Number(rateVal);
           tot.value = rate;
           return;
           onBlur();

        }
        else{
             return;
            onBlur();
        }
        let product = document.getElementById("total"+candidate).value;
        var i = document.getElementById("scoreID"+num);
        if (rate > 100){
            rate = 100;
            i.value = rate;
        }
        else if (rate < 75){
            rate = 75;
            i.value = rate;
        }
        let compute = rate * percentage;
        let final = Number(product) + Number(compute);
        total.value = final;
    }

    function onBlur(num,candidate){
        let rate = document.getElementById("scoreID"+num).value;
        let total = document.getElementById("total"+candidate);
        let product = document.getElementById("total"+candidate).value;
        let i = document.getElementById("scoreID"+num);
        if (rate > 100){
            rate = 100;
            i.value = rate;
        }
        else if (rate < 75){
            rate = 75;
            i.value = rate;
        }
        let percentage = document.getElementById("percent"+num).value;
        let compute = rate * percentage;
        let final = Number(product) + Number(compute);
        total.value = final;
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
    }

    function myFunction(){

        let maxCan = document.getElementById("maxCan").value;
        let maxX = document.getElementById("maxX").value;


        // for (let ac = 1; ac <= maxX){
           let fg = document.getElementById("scoreID1").value;
        // }

        console.log(fg);
    }


</script>

