<div>

    @php $n=0; $m=0; @endphp
    @include('components.modal_award_reg')
    @foreach($show as $shows)
        @php $total=0; $u=1 @endphp
        @if($event_id == $shows->event_id)
            <table class="table table-bordered border-primary" style="width: 47%; margin-right: 10px; margin-left: 15px; display: inline-block; margin-top: 10px;">
                <thead>
                <tr style="text-align: center;">
                    <td style="font-size: 14px;">Rank #</td>
                    <th colspan="1" style="padding: 10px 30px; background-color: whitesmoke; font-size: 20px;">{{ucwords($shows->title)}}</th>
                    <th colspan="2" data-bs-toggle="modal" data-bs-target="#award_reg" wire:click="table({{$shows->id}})" style="cursor: pointer; font-size: 25px;">+</th>
                </tr>
                </thead>

                @foreach($award_data as $shows_cri)
                    @include('components.modal_edit_award')
                    @if($shows->id == $shows_cri->portion_id)
                        <tr>
                            <td style="text-align: center;"> {{$u++}}</td>
                            <td style="width: 300px;">{{ucfirst($shows_cri->award_name)}}</td>
                            <td><img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="edit_award({{$shows_cri->id}})" data-bs-toggle="modal" data-bs-target="#edit_award{{$m++}}" style="cursor: pointer"></td>
                            <td><img src="{{url('/image/delete.png')}}" width="20" height="20" wire:click="delete_award({{$shows_cri->id}})" style="cursor: pointer;"></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @endif
    @endforeach

</div>





{{--<script>--}}
{{--    function deleteCandidate(id) {--}}
{{--        if (confirm("Are you sure to delete candidate number " + id +' ??'))--}}
{{--            window.livewire.emit('deleteCandidate', id);--}}
{{--    }--}}


{{--    window.livewire.on('fileChoosen', ()=>{--}}

{{--        let inputfield = document.getElementById('image');--}}

{{--        let file = inputfield.files[0];--}}

{{--        let reader = new FileReader();--}}

{{--        reader.onloadend = () => {--}}

{{--            window.livewire.emit('fileUpload', reader.result);--}}
{{--        }--}}

{{--        reader.readAsDataURL(file);--}}

{{--    })--}}

{{--    window.livewire.on('editCandidate', (id)=>{--}}
{{--        var num = id;--}}
{{--        let inputfield = document.getElementById('editcan'+num);--}}
{{--        let file = inputfield.files[0];--}}
{{--        let reader = new FileReader();--}}
{{--        reader.onloadend = () => {--}}

{{--            window.livewire.emit('fileCan', reader.result);--}}
{{--        }--}}

{{--        reader.readAsDataURL(file);--}}

{{--    })--}}
{{--</script>--}}
