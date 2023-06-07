<div style="margin-top: 3%; ">
    <table class="table" style="width: 100%;border:">
        @foreach($data as $datas)
            <tr>
                <td style="width: 20%; text-align: right; cursor: pointer;" onclick="location.href = '/judge/scoring-page/{{$datas->id}}';">
                    <p style="margin-left: 20px;">{{strtoupper($datas->title)}}</p>
                </td>
                <td style="text-align: center; width: 30%;">
                    <img src="{{asset('storage/'.$datas->photo)}}" width="150" height="80">
                </td>

            </tr>
        @endforeach
    </table>
</div>
