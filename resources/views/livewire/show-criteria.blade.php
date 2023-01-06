@if(count($show) > 0)

{{--    <div>--}}
{{--        @foreach($show as $shows)--}}
{{--            <ul class="list-group">--}}
{{--                <li class="list-group-item"><button onclick="deleteCriteria({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete--}}
{{--                    </button>--}}
{{--                    @foreach($show_portion as $show_portions)--}}
{{--                        @if($show_portions->id === $shows->portion_id)--}}
{{--                            {{$show_portions->title}} ---}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                        {{ucfirst($shows->title)}} - {{ucfirst($shows->percentage.'%')}}--}}



{{--                </li>--}}
{{--            </ul>--}}
{{--        @endforeach--}}
{{--    </div>--}}

    <div>
        <table class="table table-bordered border-primary">
            <tr>
                <th></th>
                <th><b>Portion</b></th>
                <th><b>Criteria</b></th>
            </tr>
                @foreach($show as $shows)

                <tr>
                    <td><button onclick="deleteCriteria({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete</button></td>
                    @foreach($show_portion as $show_portions)
                        @if($show_portions->id === $shows->portion_id)
                           <td>{{ucfirst($show_portions->title)}}</td>
                        @endif
                    @endforeach
                   <td>{{ucfirst($shows->title)}} - {{ucfirst($shows->percentage.'%')}}</td>



                </tr>
            @endforeach
            </table>

    </div>


@else
    No Data Found
@endif

@include('components.modal_criteria')

<script>
    function deleteCriteria(id) {
        if (confirm("Are you sure to delete this item ??"))
            window.livewire.emit('deleteCriteria', id);
    }

</script>
