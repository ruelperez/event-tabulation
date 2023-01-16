<div>
    @include('components.modal_title')
    @if(count($show) > 0)

        <div>
            @foreach($show as $shows)
                <ul class="list-group">
                    <li class="list-group-item">
                        <button wire:click="editTitle({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editTitle_modal" type="button" class="btn btn-warning py-1"
                                style="margin-right: 13%;">Edit
                        </button>
                        #{{$shows->id}} - {{strtoupper($shows->title)}}

                    </li>
                </ul>
            @endforeach
        </div>

    @else
        No Data Found
    @endif

</div>
