<div style="width: 60%; background-color: white; margin-left: 20%;margin-top: 3%">

    <div style="margin-left: 10%; margin-top: 5%; padding-top: 5%">
        <select class="form-select" aria-label="Default select example" id="selectTech" wire:model="selectedJudge" wire:change="handleSelectChange"
                style="width: 30%; color: white; background-color: #2F4F4F; text-align: center;">
            <option selected>Select Judge</option>
            @foreach($judge as $judges)
            <option value="{{$judges->id}}" wire:click="loadData" wire:loading.attr="disabled">{{ucwords($judges->full_name)}}</option>
            @endforeach
        </select>
        @if(isset($selectEvent))
            @include('components.modal_assignment')
        @endif
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assign" style="margin-top: 4%; margin-bottom: 2%; width: 15%; margin-left: 75%;" >Add Event</button>

    <div class="spinner-border" style="width: 3rem; height: 3rem;margin-left: 47%; margin-top: 70px;" role="status" wire:loading wire:target="loadData">
        <span class="visually-hidden">Loading...</span>
    </div>

    <div style="margin-top: 2%;" wire:loading.remove>
        @if(isset($eventData))
        <table class="table table-striped table-hover" style="width: 80%; margin-left: 10%; text-align: left">
            @foreach($eventData as $data)
                <tr>
                    <td>{{$data->title}}</td>
                    <td style="text-align: right"><img src="{{url('/image/delete.png')}}" width="20" height="20" style="cursor: pointer;" wire:click="delete({{$data->id}})"></td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>

</div>
