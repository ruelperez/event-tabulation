@include('partial.header')
{{--@dd(auth()->user()->id)--}}
<div class="d-flex">
    <div style="border: solid darkblue; height: 94px; width: 15%; padding-left: 10px;">
        <h5>Admin #{{auth()->user()->id}}</h5> <h6>{{ucwords(auth()->user()->name)}}</h6>
        <form action="/admin/logout" method="POST">
            @csrf
            <button style="border: none; background-color: white; color: blue; padding: 0px;font-size: 15px;">Logout</button>
        </form>
    </div>
    <div class="container-fluid" style="background-color: darkblue; height: 94px; padding-left: 31%; padding-top: 12px;">
        <h1 style="color: white">Event Tabulation</h1>
    </div>
</div>

<button type="button" class="btn btn-outline-success" onclick="location.href='/admin/home'" style="margin-top: 10px;margin-left: 1%; width: 8%; height: 40px;">Home</button>
<button type="button" class="btn btn-outline-success" onclick="location.href='/admin/result'" style="margin-top: 10px;margin-left: 1%; width: 8%; height: 40px;">Result</button>

<div class="row mt-4 ">
    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%;"><h4>Event Title</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#title_modal" id="boot-icon" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @livewire('show-title')

    </div>

    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Judges
                Registration</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#reg_modal" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @error('password')
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)"   class="alert alert-danger">{{ $message. " Please try again"}}</div>
        @enderror
        @include('components.message_judges')
        @livewire('show-judge')

    </div>

    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Candidate Registration</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#can_reg" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @include('components.message_candidate')
        @livewire('show-candidate')

    </div>

</div>

    @include('components.message_portion')
    @livewire('show-portion')


@include('partial.footer')
