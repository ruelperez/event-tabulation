
{{--@if(session()->has('success'))--}}
{{--    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 1000)" class="alert alert-success" role="alert">--}}
{{--        {{ session()->get('success') }}--}}
{{--    </div>--}}
{{--@endif--}}
{{--@if(session()->has('error'))--}}
{{--    <div class="alert alert-danger" role="alert">--}}
{{--        {{ session()->get('error') }}--}}
{{--    </div>--}}
{{--@endif--}}

@if(count($show) > 0)

<div>
    @foreach($show as $shows)
        <ul class="list-group">
            <li class="list-group-item"><button onclick="deleteCandidate({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete
                        </button> #{{$shows->id}} - @if($shows->full_name == "null")
                                                           {{ucfirst($shows->team_name)}}
                                                @else

                                                         {{ucfirst($shows->full_name)}}
                                                @endif


            </li>
        </ul>
    @endforeach
</div>


@else
    No Data Found
@endif

@include('components.modal_candidate_reg')

<script>
    function deleteCandidate(id) {
        if (confirm("Are you sure to delete candidate number " + id +' ??'))
            window.livewire.emit('deleteCandidate', id);
    }

</script>

