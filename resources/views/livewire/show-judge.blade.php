<div>
@include('components.modal_judges_reg')
@if(count($show) > 0)
    <div>
        @foreach($show as $shows)

            <ul class="list-group">
                @if($shows->is_chairman == 1)
                    <li class="list-group-item">
                        <button onclick="deleteJudge({{$shows->id}})" type="button" class="btn btn-danger py-1"
                                style="margin-right: 13%;">Delete
                        </button>
                        #{{$shows->judge_number}} - {{ucfirst($shows->full_name)}} - <b>chairman</b>  </li>
                @else
                    <li class="list-group-item">
                        <button onclick="deleteJudge({{$shows->id}})" type="button" class="btn btn-danger py-1"
                                style="margin-right: 13%;">Delete
                        </button>
                        #{{$shows->judge_number}} - {{$shows->full_name}}</li>
                @endif
            </ul>
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

</script>

</div>
