@include('partial.header')
<div class="container-fluid" style="background-color: darkblue; height: 70px; text-align: center; padding: 10px;">
    <h1 style="color: white">Event Tabulation</h1>
</div>

<div class="row mt-4 ">
    <div class="col-4 border">
        <div class="bg-primary text-center pt-2" style="width:106%; height: 50px; margin: auto;"><h4>Judges
                Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#reg_tModal">Click
                here</b></p>
        @include('components.message_judges')

        @livewire('show-users')

    </div>

    <div class="col-4 border border-primary">
        <div class="bg-primary text-center pt-2" style="width:106%; height: 50px; margin: auto;"><h4>Candidate
                Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#can_reg">Click
                here</b></p>
        @include('components.message_candidate')
        @livewire('show-candidate')

    <div class="col border border-primary">
        <div class="bg-primary text-center pt-2" style="width:103%; height: 50px; margin: auto;"><h4>Criteria</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#criteria">Click
                here</b></p>
        @include('components.message_criteria')
        @livewire('show-criteria')

    </div>

</div>


@include('partial.footer')
