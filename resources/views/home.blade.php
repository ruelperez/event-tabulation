@include('partial.header')
<div class="container-fluid" style="background-color: darkblue; height: 70px; text-align: center; padding: 10px;">
    <h1 style="color: white">Event Tabulation</h1>
</div>
<div class="container-fluid">
<div class="row mt-4 ">
    <div class="col border">
        <div class="bg-primary text-center pt-2" style="width:106%; height: 50px; margin: auto;"><h4>Judges Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#reg_tModal">Click here</b></p>

        @livewire('show-users')

        @include('livewire.modal_insert')


    <div class="col border border-primary">
        <div class="bg-primary text-center pt-2" style="width:106%; height: 50px; margin: auto;"><h4>Candidate Registration</h4></div>
        <p class="text-center"><b class="btn text-danger" data-bs-toggle="modal" data-bs-target="#can_reg">Click here</b></p>

        @livewire('show-candidate')

        <div class="modal fade" id="can_reg" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertModalLabel" >Fill Up Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/reg-candidate" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="team_name" placeholder="Team Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                            </div>
                            <div class="mb-3">
                                <label>Photo</label>
                                <input type="file" name="photos" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col border border-primary"> <div class="bg-primary text-center pt-2" style="width:103%; height: 50px; margin: auto;"><h4>Criteria</h4></div></div>

</div>
</div>


@include('partial.footer')
