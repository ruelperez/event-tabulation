    @php $cnt = 1; @endphp

        @foreach($criteria as $criterias)
            @if($criterias->portion_id == $portion->id)
                @if($portion->numberOfTopCandidate > 0 )
                    <input type="text" hidden id="link{{$cnt}}" value="{{$portion->numberOfTopCandidate}}" >
                @endif
            @endif
        @endforeach
    <button id="save" type="button" onclick="saveImage({{$table_id}})" class="btn btn-warning" style="width: 7%; margin-left: 89%">Save</button>
    <a id="save-image{{$table_id}}" >
        <div  id="table{{$table_id}}" class="tb">
            <table class="table table-bordered" style="margin-top: 15px;" id="tbl">
                <thead>
                <tr style="text-align: center">
                    <td colspan="3">
                        <b style="font-size: 25px;">{{ucwords($portion->title)}}</b>
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
                @php $lm=0; $final_average=0; @endphp

                @if($portion->numberOfCandidateToRate > 0 )
                    @if(count($rankData) != 0)
                        @foreach($rankData as $candidates)
                            <tr style="text-align: center;" id="candidate_row{{$counter}}{{$final_average_id}}">
                                <td>
                                    <b>{{$candidates->candidate_number}}</b>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$candidates->photo) }}" height="50" width="50" id="img{{$counter}}{{$final_average_id}}">
                                </td>
                                <td style="width:300px; font-size: 15px;">
                                    <b id="fullname{{$counter}}{{$final_average_id}}">{{ucwords(ucwords($candidates->full_name))}}</b> <br> <p style="font-size: 0.8em; " id="origin{{$counter}}{{$final_average_id}}">{{ucwords($candidates->origin)}}</p>
                                </td>
                                @php $rg=1; @endphp
                                @foreach($judge as $judges)
                                    @php $lm=0; @endphp
                                    <td>
                                        @foreach($rating as $ratings)
                                            @php $lm=0; @endphp
                                            @if($candidates->candidate_number == $ratings->candidate_number)
                                                @if($ratings->portion_id == $portion->id)
                                                    @if($ratings->judge_id == $judges->id)
                                                        @foreach($criteria as $criterias)
                                                            @if($criterias->id == $ratings->criteria_id)
                                                                @if($criterias->isLink == 1)
                                                                @elseif($ratings->isSubmit == 0)
                                                                    @php $lm = 1; break; @endphp
                                                                @endif
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
                                @php $rg--; $final_average /= $rg; $lm=0; @endphp
                                <td id="final_average{{$counter}}{{$final_average_id++}}">
                                    @php echo number_format((float)$final_average, 2, '.', ''); @endphp
                                </td>
                            </tr>
                            @php $final_average = 0; $u++; @endphp
                        @endforeach
                        <input type="text" hidden id="top_CAN" value="{{$portion->numberOfTopCandidate}}">
                        <input type="text" hidden id="quantityToRate" value="{{$quantity}}">
                        <input type="text" hidden id="count_award" value="{{count($award)}}">
                        @for($ng=0; $ng<count($award); $ng++)
                            <input type="text" hidden id="award{{$ng}}" value="{{$award[$ng]}}">
                        @endfor
                    @else
                        @foreach($candidate as $candidates)
                            <tr style="text-align: center;" id="candidate_row{{$counter}}{{$final_average_id}}">
                                <td>
                                    <b>{{$candidates->candidate_number}}</b>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$candidates->photo) }}" height="50" width="50" id="img{{$counter}}{{$final_average_id}}">
                                </td>
                                <td style="width:300px; font-size: 15px;">
                                    <b id="fullname{{$counter}}{{$final_average_id}}">{{ucwords(ucwords($candidates->full_name))}}</b> <br> <p style="font-size: 0.8em; " id="origin{{$counter}}{{$final_average_id}}">{{ucwords($candidates->origin)}}</p>
                                </td>
                                @php $rg=1; @endphp
                                @foreach($judge as $judges)
                                    @php $lm=0; @endphp
                                    <td>
                                        @foreach($rating as $ratings)
                                            @php $lm=0; @endphp
                                            @if($candidates->candidate_number == $ratings->candidate_number)
                                                @if($ratings->portion_id == $portion->id)
                                                    @if($ratings->judge_id == $judges->id)
                                                        @foreach($criteria as $criterias)
                                                            @if($criterias->id == $ratings->criteria_id)
                                                                @if($criterias->isLink == 1)
                                                                @elseif($ratings->isSubmit == 0)
                                                                    @php $lm = 1; break; @endphp
                                                                @endif
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
                                @php $rg--; $final_average /= $rg; $lm=0; @endphp
                                <td id="final_average{{$counter}}{{$final_average_id++}}">
                                    @php echo number_format((float)$final_average, 2, '.', ''); @endphp
                                </td>
                            </tr>
                            @php $final_average = 0; $u++; @endphp
                        @endforeach
                        <input type="text" hidden id="top_CAN" value="{{$portion->numberOfTopCandidate}}">
                        <input type="text" hidden id="quantityToRate" value="{{$quantity}}">
                        <input type="text" hidden id="count_award" value="{{count($award)}}">
                        @for($ng=0; $ng<count($award); $ng++)
                            <input type="text" hidden id="award{{$ng}}" value="{{$award[$ng]}}">
                        @endfor

                    @endif
                @else
                    @foreach($candidate as $candidates)
                        <tr style="text-align: center" id="candidate_row{{$counter}}{{$final_average_id}}">
                            <td>
                                <b>{{$candidates->candidate_number}}</b>
                            </td>
                            <td>
                                <img src="{{ asset('storage/'.$candidates->photo) }}" height="50" width="50" id="img{{$counter}}{{$final_average_id}}">
                            </td>
                            <td style="width:300px; font-size: 15px;">
                                <b id="fullname{{$counter}}{{$final_average_id}}">{{ucwords(ucwords($candidates->full_name))}}</b> <br> <p style="font-size: 0.8em; " id="origin{{$counter}}{{$final_average_id}}">{{ucwords($candidates->origin)}}</p>
                            </td>
                            @php $rg=1; @endphp
                            @foreach($judge as $judges)
                                @php $lm=0; @endphp
                                <td>
                                    @foreach($rating as $ratings)
                                        @php $lm=0; @endphp
                                        @if($candidates->candidate_number == $ratings->candidate_number)
                                            @if($ratings->portion_id == $portion->id)
                                                @if($ratings->judge_id == $judges->id)
                                                    @foreach($criteria as $criterias)
                                                        @if($criterias->id == $ratings->criteria_id)
                                                            @if($criterias->isLink == 1)
                                                            @elseif($ratings->isSubmit == 0)
                                                                @php $lm = 1; break; @endphp
                                                            @endif
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
                            @php $rg--; $final_average /= $rg; $lm=0; @endphp
                            <td id="final_average{{$counter}}{{$final_average_id++}}">
                                @php echo number_format((float)$final_average, 2, '.', ''); @endphp
                            </td>
                        </tr>
                        @php $final_average = 0; $u++; @endphp
                    @endforeach
                    <input type="text" hidden id="top_CAN" value="{{$portion->numberOfTopCandidate}}">
                    <input type="text" hidden id="quantityToRate" value="{{$quantity}}">
                    <input type="text" hidden id="count_award" value="{{count($award)}}">
                    @for($ng=0; $ng<count($award); $ng++)
                        <input type="text" hidden id="award{{$ng}}" value="{{$award[$ng]}}">
                    @endfor



                @endif
                </tbody>
            </table>
            @php $average_id = $final_average_id - 1; @endphp
            @php $counter++; @endphp
            <input hidden type="text" id="count_candidate" value="{{$u-1}}">
            @php $u = 1; $final_average_id = 1; $table_id++; @endphp

            <div class="container-fluid" style="background-color: darkblue; text-align: center; color: white; margin-bottom: 30px; height: 40px;padding-top: 8px;">Board of Judges</div>
                <div style="margin-left: 10%; margin-bottom: 150px;">
                @foreach($judge as $judges)
                    <div style="display: inline-block; margin-right: 15%; ">
                        <b>{{ucwords($judges->full_name)}}</b> <br> <p style="font-size: 0.9em; ">Judge# {{$judges->judge_number}}</p>
                    </div>
                @endforeach
                </div>

        </div>

        @php $cnt++; @endphp
        <input hidden type="text" id="count_average" value="{{$average_id}}">
        <input hidden type="text" id="count_table" value="{{$counter = $counter-1}}">


    <div id="divBody" style="width: 100%;">

    </div>

    </a>
