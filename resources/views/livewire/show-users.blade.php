<div>
    @foreach($show as $shows)

        <table class="table mx-auto" style="width: 30%;">
            <tr>
                @if($shows->user_type == "chairman")
                <td>{{$shows->name}}</td>
                <td>{{$shows->user_type}}</td>
                @else
                    <td>{{$shows->name}}</td>
                @endif
            </tr>
        </table>

    @endforeach
</div>
