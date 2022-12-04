@if(count($show) > 0)

    <div>
        @foreach($show as $shows)
            <ul class="list-group">
                <li class="list-group-item"><button onclick="deleteCriteria({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete
                    </button>
                        {{ucfirst($shows->name)}} - {{ucfirst($shows->percentage.'%')}}



                </li>
            </ul>
        @endforeach
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
