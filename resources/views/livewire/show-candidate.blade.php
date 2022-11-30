<div>
    @foreach($show as $shows)

        <table class="table mx-auto border-primary" style="width: 30%;">
            <tr>
                <td>{{$shows->id}}</td>
                <td>{{$shows->last_name}}</td>
                <td>{{$shows->firs_name}}</td>
            </tr>
        </table>

    @endforeach
</div>
