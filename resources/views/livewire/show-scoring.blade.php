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
            @foreach($portion as $portions)
                <li class="list-group-item btn" @if($pass == $portions->id or $ber++==1) style="background-color: aquamarine" @endif wire:click="getData({{$portions->id}})">
                    {{ucwords($portions->title)}}
                </li>
            @endforeach
        </ul>

    </div>

    @foreach($portion as $portions)
    <form wire:submit.prevent="submit" style="margin-left: 20px;display: @if($pass == $portions->id) block @elseif($num++==1) block @endif none">
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
                        <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em";>{{ucwords($candidates->origin)}}</p></td>
                        @foreach($criteria as $criterias)
                        @if($criterias->portion_id == $portions->id)
                            <input type="text" hidden wire:model="judge_id">
                            <input type="text" hidden wire:model="candidate_id.{{$candidates->candidate_number}}.{{$x}}">
                            <input type="text" hidden wire:model="criteria_id.{{$candidates->candidate_number}}.{{$x}}">
                            <td><input type="text" class="form-control" wire:model.lazy="rating.{{$candidates->candidate_number}}.{{$x++}}"  style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" required></td>
                        @endif
                        @endforeach
                            <td><input type="text" class="form-control"  wire:model.lazy="total.{{$candidates->candidate_number}}"  style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <button type="submit" class="btn btn-info" style="width: 40%; margin-left: 30%;">Submit</button>
{{--@if(isset($rate[0]))--}}
{{--        {{$rate[0]}}--}}
{{--@endif--}}
    </form>

    @endforeach
    </div>
</div>

{{--<script>--}}
{{--    function displayForm(id){--}}

{{--       var getform = document.getElementById("formID"+id);--}}
{{--        if (getform.style.display == "none") {--}}
{{--            getform.style.display = "block";--}}
{{--        }--}}
{{--    }--}}

{{--</script>--}}

