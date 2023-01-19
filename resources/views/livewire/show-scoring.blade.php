<div class="d-flex container-fluid">
    <div style="width: 20%;border: solid blue">
        <ul class="list-group" style="width: 100%;">
            <li class="list-group-item" style="text-align: center">Portion</li>
            @foreach($portion as $portions)
                <li class="list-group-item btn" style="text-align: left;" wire:click="fetch({{$portions->id}})">{{ucwords($portions->title)}}</li>
            @endforeach
        </ul>

    </div>
    <form wire:submit.prevent="submit">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="3" style="text-align: center; padding-bottom: 18px; font-size: 25px;">{{ucwords($por_name)}}</th>
                @foreach($criteria as $criterias)
                    <th style="text-align: center; width: 500px;" >{{ucwords($criterias->title)}} <br> ({{($criterias->percentage)}}%)</th>
                @endforeach
                <th style="text-align: center; width: 13%;">Total</th>
            </tr>
            </thead>
            <tbody>

                @foreach($candidate as $candidates)
                    <tr>
                        <th style="text-align: center; width: 200px; font-size: 20px; padding-top: 23px;">{{$candidates->id}}</th>
                        <td><img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70"/></td>
                        <td style="width:600px; font-size: 15px;"><b>{{ucwords($candidates->full_name)}}</b> <br> <p style="font-size: 0.8em";>{{ucwords($candidates->origin)}}</p></td>
                        @foreach($criteria as $criterias)

                            <input type="text" hidden wire:model="judge_id">
                            <input type="text" hidden wire:model="candidate_id.{{$candidates->id}}.{{$x}}">
                            <input type="text" hidden wire:model="criteria_id.{{$candidates->id}}.{{$x}}">
                            <td><input type="text" wire:model.lazy="rating.{{$candidates->id}}.{{$x++}}" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" required></td>
                        @endforeach
                            <td><input type="text" disabled wire:model.lazy="total.{{$candidates->id}}" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <button type="submit" class="btn btn-info" style="width: 40%; margin-left: 30%;">Submit</button>
{{--@if(isset($rate[0]))--}}
{{--        {{$rate[0]}}--}}
{{--@endif--}}
    </form>
    </div>
<div>


