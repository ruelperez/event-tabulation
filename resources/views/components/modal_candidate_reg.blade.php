<div class="modal fade" id="can_reg" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Fill Up Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" x-data="{show : false, appear : false}">
                <div class="row text-center" style="height: 40px;" >
                    <div class="divs col border border-primary" @click="show = true, appear = false" style="padding-top: 5px; ">Individual</div>
                    <div class="col border border-primary" @click="appear = true, show = false" style="padding-top: 5px; ">Group</div>
                </div>

                <form action="/reg-candidate-individual" method="POST" x-show="show" style="margin-top: 10px;">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name"
                               required>
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" name="team_name" value="null" placeholder="Team Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


                <form action="/reg-candidate-group" method="POST" x-show="appear" style="margin-top: 10px;">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" name="fullname" value="null" placeholder="Full Name"
                               required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="team_name" placeholder="Team Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
