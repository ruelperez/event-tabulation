<div class="d-flex container-fluid">
    <div style="width: 20%;border: solid blue">
        <ul class="list-group" style="width: 100%;">
            <li class="list-group-item" style="text-align: center">Portion</li>
            @foreach($portion as $portions)
                <li class="list-group-item btn" style="text-align: left;" wire:click="fetch({{$portions->id}})">{{$portions->id}} {{ucfirst($portions->title)}}</li>
            @endforeach
        </ul>
<h1>{{$ids  }}</h1>

    </div>
    <form wire:submit.prevent="submit">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                @foreach($criteria as $criterias)
                    <th style="text-align: center; width: 500px;" >{{ucfirst($criterias->title)}} <br> ({{ucfirst($criterias->percentage)}}%)</th>
                @endforeach
                <th style="text-align: center; width: 13%;">Total</th>
            </tr>
            </thead>
            <tbody>

                @foreach($candidate as $candidates)
                    <tr>
                        <th style="text-align: center; width: 10%;">{{$candidates->id}}</th>
                        <td>photos</td>
                        <td style="width:600px;">{{$candidates->full_name}} <br> <p style="font-size: 0.8em";>{{$candidates->origin}}</p></td>
                        @foreach($criteria as $criterias)

                            <input type="text" hidden wire:model="judge_id">
                            <input type="text" hidden wire:model="candidate_id.{{$x}}">
                            <input type="text" hidden wire:model="criteria_id.{{$x}}">
                            <td><input type="text" wire:model.lazy="rating.{{$x++}}" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center" required></td>
                        @endforeach
                            <td><input type="text" wire:model.lazy="total.{{$candidates->id}}" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>

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


