<div class="container-fluid">

    <div class="row mt-4 ">
        <div class="col-4 border border-primary" style="text-align: center">
            <img src="{{ asset('storage/'.$event_data->photo) }}" width="500">
            <h4 style="margin-top: 10px;"><i>{{strtoupper($event_data->title)}}</i></h4>

            <ul class="list-group" style="width: 100%; margin-top: 30px;" >
                <li  class="list-group-item btn" style="@if($regis == "judge") background-color: aquamarine; @endif"  onclick="location.href = '/admin/registration/judge/{{$eventNUM}}';">
                    Judges
                </li>
                <li  class="list-group-item btn" style="@if($regis == "candidate") background-color: aquamarine; @endif" onclick="location.href = '/admin/registration/candidate/{{$eventNUM}}';">
                    Candidate
                </li>
                <li wire:ignore.self class="list-group-item btn" style="@if($regis == "portion") background-color: aquamarine; @endif" onclick="location.href = '/admin/registration/portion/{{$eventNUM}}';">
                    Portion
                </li>
                <li wire:ignore.self class="list-group-item btn" style="@if($regis == "criteria") background-color: aquamarine; @endif" onclick="location.href = '/admin/registration/criteria/{{$eventNUM}}';">
                    Criteria
                </li>

            </ul>
{{--            <h4 style="margin-top: 10px; "><i><b>{{ucwords($event_data->title)}}</b></i></h4>--}}
{{--            --}}{{--this include the RESULT BUTTON inside livewire('delete-score')--}}
{{--            @livewire('delete-score', ['eventNUM' => $eventNUM])--}}

        </div>

        <div class="col-8 border border-primary">
            <div style=" @if($regis == 'judge') @else display: none @endif ">
                <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Judges
                        Registration</h4></div>
                <span class="btn" data-bs-toggle="modal" data-bs-target="#reg_modal" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
                @error('password')
                <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)"   class="alert alert-danger">{{ $message. " Please try again"}}</div>
                @enderror
                @include('components.message_judges')
                @livewire('show-judge', ['eventNUM' => $eventNUM])
            </div>

            <div style=" @if($regis == 'candidate') @else display: none @endif ">
                <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Candidate Registration</h4></div>
                <span class="btn" data-bs-toggle="modal" data-bs-target="#can_reg" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
                @include('components.message_candidate')
                @livewire('show-candidate', ['eventNUM' => $eventNUM])
            </div>

            @include('components.message_portion')
                @livewire('show-portion', ['eventNUM' => $eventNUM, 'imbed' => $regis])
        </div>


    </div>

</div>

