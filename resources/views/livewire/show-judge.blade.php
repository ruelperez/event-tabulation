<div>


@if(count($show) > 0)
        @php $v=0; @endphp
    <div>
        @foreach($show as $shows)
            @include('components.modal_judges_reg')
            @include('components.modal_edit_judge')
            @if($event_id == $shows->event_id)
                <ul class="list-group" style="width: 70%; margin-left: 15%;">

                    @if($shows->is_chairman == 1)
                        <li class="list-group-item">
                            <img src="{{url('storage/'.$shows->photo)}}" width="40" height="40" style="margin-right: 20px;">
                            #{{$shows->judge_number}} - {{ucfirst($shows->full_name)}} - <b>chairman</b>
                            <img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="edit_can({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editCandidate" style="cursor: pointer; position: absolute; right: 40px;">
                            <img src="{{url('/image/delete.png')}}" width="20" height="20" onclick="deleteJudge({{$shows->id}})" style="cursor: pointer; position: absolute; right: 10px;">
                        </li>
                    @else
                        <li class="list-group-item">
                            <img src="{{url('storage/'.$shows->photo)}}" width="40" height="40" style="margin-right: 20px;">
                            #{{$shows->judge_number}} - {{$shows->full_name}}
                            <img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="judgeEdit({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#judgeEdit{{$v++}}" style="cursor: pointer; position: absolute; right: 40px;">
                            <img src="{{url('/image/delete.png')}}" width="20" height="20" onclick="deleteJudge({{$shows->id}})" style="cursor: pointer; position: absolute; right: 10px;">
                        </li>
                    @endif
                </ul>
            @endif
        @endforeach
    </div>

@else
    <div> No Data Found</div>
@endif

<script>
    function deleteJudge(id) {
        if (confirm("Are you sure to delete this record???"))
            window.livewire.emit('deleteJudge', id);
    }

    window.livewire.on('fileChoose', ()=>{

        let inputfield = document.getElementById('judge_photo');

        let file = inputfield.files[0];

        let reader = new FileReader();

        reader.onloadend = () => {

            window.livewire.emit('Upload', reader.result);
        }

        reader.readAsDataURL(file);

    })

    window.livewire.on('editjudge', (id)=>{
        var num = id;
        let inputfield = document.getElementById('editjud'+num);
        let file = inputfield.files[0];
        let reader = new FileReader();
        reader.onloadend = () => {

            window.livewire.emit('fileJud', reader.result);
        }

        reader.readAsDataURL(file);

    })

</script>

</div>
