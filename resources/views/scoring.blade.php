@include('partial.header')

<div class="container-fluid">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            @foreach($criteria as $criterias)
                <th style="text-align: center;" scope="col">{{ucfirst($criterias->name)}} <br> ({{ucfirst($criterias->percentage)}}%)</p></th>
            @endforeach
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            @foreach($candidate as $candidates)
            <tr>
                <th>{{$candidates->id}}</th>
                <td>photos</td>
                <td>{{$candidates->fullname}} <br> <p style="font-size: 0.8em";>{{$candidates->address}}</p></td>
                @foreach($criteria as $criterias)
                    <form>
                        <td><input type="text" placeholder="00.00" style="width: 50%; height: 40px; margin-left: 25%; margin-top: 10px; text-align: center"></td>
                    </form>
                @endforeach

            </tr>
            @endforeach

        </tbody>
    </table>
</div>


@include('partial.footer')
