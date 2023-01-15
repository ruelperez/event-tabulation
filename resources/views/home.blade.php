@include('partial.header')
{{--@dd(auth()->user()->id)--}}
<h4>ADMIN {{auth()->user()->id}}</h4> <h4>{{auth()->user()->name}}</h4>
<form action="/admin/logout" method="POST">
    @csrf
    <button style="margin-left: 93%; width: 6%;">logout</button>
</form>
<div class="container-fluid" style="background-color: darkblue; height: 70px; text-align: center; padding: 10px;">
    <h1 style="color: white">Event Tabulation</h1>
</div>

<div class="row mt-4 ">
    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%;"><h4>Event Title</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#title_modal">Click
                here</b></p>
        @livewire('show-title')

    </div>

    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Judges
                Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#reg_modal">Click
                here</b></p>
        @error('password')
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)"   class="alert alert-danger">{{ $message. " Please try again"}}</div>
        @enderror
        @include('components.message_judges')
        @livewire('show-judge')

    </div>

    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:100%; height: 50px;"><h4>Candidate Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#can_reg">Click
                here</b></p>
        @include('components.message_candidate')

        @livewire('show-candidate')
        @include('components.modal_candidate_reg')

    <div class="col-4 border border-primary" style="margin-top: 30px;">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%;"><h4>Portion</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#portion_modal">Click
                here</b></p>
        @include('components.message_portion')
        @include('components.modal_portion')
        @livewire('show-portion')

    </div>

    <div class="col-4 border border-primary" style="margin-top: 30px;">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px;"><h4>Criteria</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#criteria">Click
                here</b></p>
        @include('components.message_criteria')
        @livewire('show-criteria')

    </div>

</div>
    <button type="button" class="btn btn-outline-success" onclick="location.href='/home';" style="margin-top: 20px;margin-left: 40%; width: 20%; height: 50px;">Finished</button>


@include('partial.footer')
