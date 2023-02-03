<div>
    @foreach($portion as $portions)
    <table class="table" style="margin-bottom: 20px;">
        <thead>
        <tr style="text-align: center">
            <td colspan="3">
                <b>{{ucwords($portions->title)}}</b>
            </td>
            @foreach($judge as $judges)
            <td>
                <b>Judge #{{$judges->judge_number}}</b>
            </td>
            @endforeach
            <td>
                <b>Final Average</b>
            </td>
            <td>
                <b>Rank</b>
            </td>
        </tr>
        </thead>

        <tbody>
        @foreach($candidate as $candidates)
        <tr style="text-align: center">
            <td>
                <b>{{$candidates->candidate_number}}</b>
            </td>
            <td>
                <img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70">
            </td>
            <td style="width:300px; font-size: 15px;">
                <b>{{ucwords(ucwords($candidates->full_name))}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p>
            </td>
            @foreach($judge as $judges)
                <td>
                    @foreach($rating as $ratings)
                        @if($candidates->candidate_number == $ratings->candidate_number)
                            @if($ratings->portion_id == $portions->id)
                                @if($ratings->judge_id == $judges->id)
                                    @foreach($criteria as $criterias)
                                            @if($criterias->id == $ratings->criteria_id)
                                                @php  $total = $criterias->percentage  * $ratings->rating / 100;
                                                      $final += $total;
                                                      $t++;
                                                @endphp
                                            @endif
                                    @endforeach
                                @endif
                            @endif
                        @endif
                    @endforeach
                    {{$final}}
                </td>
                @php $final = 0; @endphp
            @endforeach
        </tr>
        @endforeach
        </tbody>
    </table>
    @endforeach

</div>


