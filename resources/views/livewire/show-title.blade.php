<div>
    @include('components.modal_title')
    @if(count($show) > 0)

        <div>
            @foreach($show as $shows)
                <ul class="list-group">
                    <li class="list-group-item">
                        <button wire:click="editTitle({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editTitle_modal" type="button" class="btn btn-warning py-1"
                                style="margin-right: 10%;">Edit
                        </button>
                        {{strtoupper($shows->title)}} <img src="{{asset('storage/'.$shows->photo)}}" width="150" height="80" style="margin-left: 10px;">

                    </li>
                </ul>
            @endforeach
        </div>

    @else
        No Data Found
    @endif

</div>

<script>
    window.livewire.on('choosen', ()=>{

        let inputfield = document.getElementById('titleImage');

        let file = inputfield.files[0];

        let reader = new FileReader();

        reader.onloadend = () => {

            window.livewire.emit('files', reader.result);
        }

        reader.readAsDataURL(file);

    })

    window.livewire.on('editChoosen', ()=>{

        let inputfield = document.getElementById('editTitle');

        let file = inputfield.files[0];

        let reader = new FileReader();

        reader.onloadend = () => {

            window.livewire.emit('files', reader.result);
        }

        reader.readAsDataURL(file);

    })
</script>
