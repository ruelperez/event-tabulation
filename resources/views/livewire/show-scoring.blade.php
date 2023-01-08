<div class="d-flex container-fluid">
    <div style="width: 20%;border: solid blue">
        <ul class="list-group" style="width: 100%;">
            <li class="list-group-item" style="text-align: center">Portion</li>
            @foreach($portion as $portions)
                <li class="list-group-item btn" style="text-align: left;" wire:click="fetch_Criteria({{$portions->id}})" >{{ucfirst($portions->title)}}</li>

            @endforeach
        </ul>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            @foreach($criteria as $criterias)
                @if($criterias->portion_id == )
                <th style="text-align: center; width: 13%;" >{{ucfirst($criterias->title)}} <br> ({{ucfirst($criterias->percentage)}}%)</p></th>
            @endforeach
            <th style="text-align: center; width: 13%;">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($candidate as $candidates)
            <tr>
                <th style="text-align: center">{{$candidates->id}}</th>
                <td>photos</td>
                <td>{{$candidates->full_name}} <br> <p style="font-size: 0.8em";>{{$candidates->origin}}</p></td>
                @foreach($criteria as $criterias)
                    <form>
                        <td><input type="text" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>

                @endforeach
                        <td><input type="text" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                    </form>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

