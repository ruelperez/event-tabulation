<div>
    @if(count($show) > 0)
        @php $v=0; @endphp
        @foreach($show as $shows)
            @include('components.modal_candidate_reg')
            @if($event_id == $shows->event_id)
                <ul class="list-group">
                    <li class="list-group-item">
                         <img src="{{ asset('storage/'.$shows->photo) }}" height="50" width="50" style="margin-right: 20px;"/>
                                #{{$shows->candidate_number}} - {{ucfirst($shows->full_name)}}
                        <img src="{{url('/image/delete.png')}}" width="20" height="20" onclick="deleteCandidate({{$shows->id}})" style="cursor: pointer; right: 10px;position: absolute">
                        <img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="edit_can({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editCandidate{{$v++}}" style="cursor: pointer; position: absolute; right: 40px;">
                    </li>

                </ul>
            @endif
        @endforeach

    @else
     No data
        @include('components.modal_candidate_editReg')
    @endif

</div>




<script>
    function deleteCandidate(id) {
        if (confirm("Are you sure to delete candidate number " + id +' ??'))
            window.livewire.emit('deleteCandidate', id);
    }


    window.livewire.on('fileChoosen', ()=>{

        let inputfield = document.getElementById('image');

        let file = inputfield.files[0];

        let reader = new FileReader();

        reader.onloadend = () => {

            window.livewire.emit('fileUpload', reader.result);
        }

        reader.readAsDataURL(file);

    })

    window.livewire.on('editCandidate', (id)=>{
        var num = id;
        let inputfield = document.getElementById('editcan'+num);
        let file = inputfield.files[0];
        let reader = new FileReader();
        reader.onloadend = () => {

            window.livewire.emit('fileCan', reader.result);
        }

        reader.readAsDataURL(file);

    })
</script>
