@if(count($show) > 0)

    <div>
        @foreach($show as $shows)
            <ul class="list-group">
                <li class="list-group-item"><button onclick="deleteTitle({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 13%;">Delete
                    </button>
                    {{strtoupper($shows->name)}}



                </li>
            </ul>
        @endforeach
    </div>


@else
    No Data Found
@endif

@include('components.modal_title')

<script>
    function deleteTitle(id) {
        if (confirm("Are you sure to delete this item ??"))
            window.livewire.emit('deleteTitle', id);
    }

</script>