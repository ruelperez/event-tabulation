<div>
    <div style=" @if($imbeds == "portion") @else display: none @endif ">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%;"><h4>Portion</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#portion_modal" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @include('components.modal_portion')
        @if(count($show) > 0)
            @php $d=0; @endphp
            @foreach($show as $shows)
                @include('components.modal_portion_edit')
                @if($event_id == $shows->event_id)
                    <ul class="list-group" style="width: 70%; margin-left: 15%">
                        <li class="list-group-item">
                            {{strtoupper($shows->title)}}
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

    <div style=" @if($imbeds == "criteria") @else display: none @endif ">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px;"><h4>Criteria</h4></div>

            @php $m=0; @endphp
        @include('components.modal_criteria')
            @foreach($show as $shows)
                @php $total=0; @endphp
                @if($event_id == $shows->event_id)
                    <table class="table table-bordered border-primary" style="width: 47%; margin-right: 10px; margin-left: 15px; display: inline-block; margin-top: 10px;">
                        <thead>
                            <tr style="text-align: center;">
                                <th colspan="2" style="padding: 10px 30px; background-color: whitesmoke">{{ucwords($shows->title)}}</th>
                                <th colspan="2" data-bs-toggle="modal" data-bs-target="#criteria" wire:click="table({{$shows->id}})" style="cursor: pointer; font-size: 25px;">+</th>
                            </tr>
                        </thead>

                        @foreach($show_cri as $shows_cri)
                            @if($shows->id == $shows_cri->portion_id)
                                @include('components.modal_edit_criteria')
                            <tr>
                                <td style="width: 300px;">{{ucfirst($shows_cri->title)}}</td>
                                <td style="width: 100px;">{{ucfirst($shows_cri->percentage.'%')}}</td>
                                <td><img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="edit_cri({{$shows_cri->id}},{{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editCriteria{{$shows_cri->id}}{{$shows->id}}" style="cursor: pointer"></td>
                                <td><img src="{{url('/image/delete.png')}}" width="20" height="20" wire:click="delete_cri({{$shows_cri->id}})" style="cursor: pointer;"></td>
                            </tr>
                                @php $total += $shows_cri->percentage @endphp
                            @endif
                        @endforeach
                        <tr>
                            <td><b>Total</b></td>
                            <td colspan="3" style="text-align: center"><b>{{$total}}%</b></td>
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
