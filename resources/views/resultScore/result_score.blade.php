<div>
    @foreach($portion as $portions)
        <table class="table" style="margin-bottom: 20px;" id="table{{$table_id}}">
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
                <tr style="text-align: center" id="candidate_row{{$counter}}{{$final_average_id}}">
                    <td>
                        <b>{{$candidates->candidate_number}}</b>
                    </td>
                    <td>
                        <img src="{{ asset('storage/'.$candidates->photo) }}" height="70" width="70">
                    </td>
                    <td style="width:300px; font-size: 15px;">
                        <b>{{ucwords(ucwords($candidates->full_name))}}</b> <br> <p style="font-size: 0.8em; ">{{ucwords($candidates->origin)}}</p>
                    </td>
                    @php $rg=1; @endphp
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
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                            {{$final}}
                        </td>
                        @php $rg++; $final_average += $final; $final = 0; @endphp
                    @endforeach
                    @php $rg--; $final_average /= $rg @endphp
                    <td id="final_average{{$counter}}{{$final_average_id++}}">
                        @php echo number_format((float)$final_average, 2, '.', ''); @endphp
                    </td>
                </tr>
                @php $final_average = 0; $u++; @endphp
            @endforeach
            </tbody>
        </table>
        @php $average_id = $final_average_id - 1; @endphp
        @php $counter++; @endphp
        <input type="text" id="count_candidate" value="{{$u-1}}">
        @php $u = 1; $final_average_id = 1; @endphp
    @endforeach
        <input type="text" id="count_average" value="{{$average_id}}">
        <input type="text" id="count_table" value="{{$counter = $counter-1}}">

</div>


