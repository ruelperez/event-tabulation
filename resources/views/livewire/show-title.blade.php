<div>
    @include('components.modal_title')
    @if(count($show) > 0)

        <div>
            <table class="table" style="width: 100%;">
                @foreach($show as $shows)
                    <tr>
                        <td style="width: 250px;">
                            <p style="margin-left: 20px;">{{strtoupper($shows->title)}}</p>
                        </td>
                        <td>
                            <img src="{{asset('storage/'.$shows->photo)}}" width="150" height="80">
                        </td>
                        <td style="text-align: right">
                            <a href="{{url('admin/registration', ['eventNUM' => $shows->id])}}" style="cursor: pointer;">Inspect</a>
                            <img src="{{url('/image/edit.png')}}" width="18" height="18" wire:click="editTitle({{$shows->id}})" data-bs-toggle="modal" data-bs-target="#editTitle_modal" style="cursor: pointer; margin-left: 10px;">

                        </td>
                    </tr>
                @endforeach
            </table>

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
