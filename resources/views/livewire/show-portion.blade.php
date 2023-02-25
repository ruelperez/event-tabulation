<div class="row">
    <div class="col-4 border border-primary" style="margin-top: 30px;">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%;"><h4>Portion</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#portion_modal" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @include('components.modal_portion')
        @if(count($show) > 0)
            @php $d=0; @endphp
            @foreach($show as $shows)
                @include('components.modal_portion_edit')
                @if($event_id == $shows->event_id)
                    <ul class="list-group">
                        <li class="list-group-item">
                            #{{$shows->id}} - {{strtoupper($shows->title)}}
                            <img src="{{url('/image/edit.png')}}" width="20" height="20" wire:click="edit_por({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editPortion{{$d}}" style="cursor: pointer;position: absolute;right: 45px;">
                            <img src="{{url('/image/delete.png')}}" width="20" height="20" onclick="deleteTitles({{$shows->id}})" style="cursor: pointer; position: absolute;right: 10px;">
                        </li>
                    </ul>
                @endif
            @endforeach
        @else
            @include('components.modal_portion')
            No Data Found
        @endif
    </div>

    <div class="col-8 border border-primary" style="margin-top: 30px;">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px;"><h4>Criteria</h4></div>

            @php $n=0; $m=0; @endphp

            @foreach($show as $shows)
                @php $total=0; @endphp
                @include('components.modal_criteria')
                @if($event_id == $shows->event_id)
                    <table class="table table-bordered border-primary" style="width: 30%; display: inline-block; margin-top: 10px;">
                        <thead>
                            <tr style="text-align: center;">
                                <th colspan="2" style="padding: 10px 30px;">{{ucwords($shows->title)}}</th>
                                <th colspan="2" data-bs-toggle="modal" data-bs-target="#criteria{{$n++}}" wire:click="table({{$shows->id}})" style="cursor: pointer; font-size: 25px;">+</th>
                            </tr>
                        </thead>

                        @foreach($show_cri as $shows_cri)
                            @include('components.modal_edit_criteria')
                            @if($shows->id == $shows_cri->portion_id)
                            <tr>
                                <td>{{ucfirst($shows_cri->title)}}</td>
                                <td>{{ucfirst($shows_cri->percentage.'%')}}</td>
                                <td><img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="edit_cri({{$shows_cri->id}},{{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editCriteria{{$m++}}" style="cursor: pointer"></td>
                                <td><img src="{{url('/image/delete.png')}}" width="20" height="20" wire:click="delete_cri({{$shows_cri->id}})" style="cursor: pointer;"></td>
                            </tr>
                                @php $total += $shows_cri->percentage @endphp
                            @endif
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td colspan="3" style="text-align: center"><h5>{{$total}}%</h5></td>
                        </tr>
                    </table>
               @endif
            @endforeach

    </div>

<script>
    function deleteTitles(id) {
        if (confirm("Are you sure to delete this item ??"))
            window.livewire.emit('deleteTitles', id);
    }

    function deleteCriteria(id) {
    if (confirm("Are you sure to delete this item ??"))
    window.livewire.emit('deleteCriteria', id);
}


</script>
</div>
