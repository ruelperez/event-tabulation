<div>
@include('components.modal_candidate_reg')
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
 No data
@endif

<script>
    function deleteCandidate(id) {
        if (confirm("Are you sure to delete candidate number " + id +' ??'))
            window.livewire.emit('deleteCandidate', id);
    }

</script>

    <script>
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

</div>
