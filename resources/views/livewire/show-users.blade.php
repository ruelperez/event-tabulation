{{--@if(session()->has('success'))--}}
{{--    <div class="alert alert-success" role="alert">--}}
{{--        {{ session()->get('success') }}--}}
{{--    </div>--}}

{{--@elseif(session()->has('error'))--}}
{{--    <div class="alert alert-danger" role="alert">--}}
{{--        {{ session()->get('error') }}--}}
{{--    </div>--}}
{{--@endif--}}
@if(count($show) > 0)
    <div>
        @foreach($show as $shows)

            <ul class="list-group">
                @if($shows->user_type == "chairman")
                    <li class="list-group-item">
                        <button onclick="deleteJudge({{$shows->id}})" type="button" class="btn btn-danger py-1"
                                style="margin-right: 13%;">Delete
                        </button>{{ucfirst($shows->name)}} - {{$shows->user_type}}  </li>
                @else
                    <li class="list-group-item">
                        <button onclick="deleteJudge({{$shows->id}})" type="button" class="btn btn-danger py-1"
                                style="margin-right: 13%;">Delete
                        </button>{{$shows->name}}</li>
                @endif
            </ul>
        @endforeach
    </div>

@else
    <div> No Data Found</div>

@endif

@include('components.modal_judges_reg')

<script>
    function deleteJudge(id) {
        if (confirm("Are you sure to delete this record???"))
            window.livewire.emit('deleteJudge', id);
    }


</script>
