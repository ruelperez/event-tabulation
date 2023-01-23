<div>

    @include('components.modal_candidate_reg')
    @if(count($show) > 0)

        @foreach($show as $shows)

            <ul class="list-group">
                <li class="list-group-item"><button onclick="deleteCandidate({{$shows->id}})" type="button" class="btn btn-danger py-1" style="margin-right: 5%;">Delete
                            </button> <img src="{{ asset('storage/'.$shows->photo) }}" height="50" width="50" style="margin-right: 20px;"/>
                            #{{$shows->candidate_number}} - {{ucfirst($shows->full_name)}}
                </li>


            </ul>

        @endforeach

    @else
     No data
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
</script>
