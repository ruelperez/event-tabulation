<div>
    @include('components.modal_criteria')
{{--@if(count($show) > 0)--}}
       <a href="/admin/home"><img src="{{url('image/reload.png')}}" width="30" height="30"  style="margin-left: 46%; margin-top: 10px;"></a>
    <div>
        @foreach($show_portion as $show_portions)
        <table class="table table-bordered border-primary" style="width: 250px; display: inline-block; position: relative;">
            <tr style="text-align: center">
                <td>{{ucwords($show_portions->title)}}</td>
            </tr>
            @foreach($show as $shows)
            <tr>
                <td>{{ucfirst($shows->title)}} - {{ucfirst($shows->percentage.'%')}}</td>
            </tr>
            @endforeach
        </table>
        @endforeach
{{--        <table class="table table-bordered border-primary">--}}
{{--            <tr>--}}
{{--                <th></th>--}}
{{--                <th><b>Portion</b></th>--}}
{{--                <th><b>Criteria</b></th>--}}
{{--            </tr>--}}
{{--                @foreach($show as $shows)--}}

{{--                <tr>--}}
{{--                    <td><button onclick="deleteCriteria({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete</button></td>--}}
{{--                    @foreach($show_portion as $show_portions)--}}
{{--                        @if($show_portions->id == $shows->portion_id)--}}
{{--                           <td>{{ucfirst($show_portions->title)}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                   <td>{{ucfirst($shows->title)}} - {{ucfirst($shows->percentage.'%')}}</td>--}}



{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </table>--}}

    </div>


{{--@else--}}
{{--    No Data Found--}}
{{--@endif--}}

@include('components.modal_criteria')

<script>
    function deleteCriteria(id) {
        if (confirm("Are you sure to delete this item ??"))
            window.livewire.emit('deleteCriteria', id);
    }

</script>
</div>
