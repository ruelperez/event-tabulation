<div>

    <div class="row mt-4 ">
        <div class="col-4" style="text-align: center">
            <img src="{{asset('storage/'.$event_data->photo)}}" style="width: 90%; height: 200px;"> <br>
            <h4 style="margin-top: 10px; "><b>{{ucwords($event_data->title)}}</b></h4>

        </div>

        <div class="col-4 border border-primary">
            <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Judges
                    Registration</h4></div>
            <span class="btn" data-bs-toggle="modal" data-bs-target="#reg_modal" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
            @error('password')
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)"   class="alert alert-danger">{{ $message. " Please try again"}}</div>
            @enderror
            @include('components.message_judges')
            @livewire('show-judge', ['eventNUM' => $eventNUM])

        </div>

        <div class="col-4 border border-primary">
            <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Candidate Registration</h4></div>
            <span class="btn" data-bs-toggle="modal" data-bs-target="#can_reg" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
            @include('components.message_candidate')
            @livewire('show-candidate', ['eventNUM' => $eventNUM])

        </div>

    </div>

    @include('components.message_portion')
    @livewire('show-portion', ['eventNUM' => $eventNUM])
</div>

