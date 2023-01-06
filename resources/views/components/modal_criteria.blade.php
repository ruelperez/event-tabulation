
<div class="modal" tabindex="-1" role="dialog" id="criteria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Input Criteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/criteria" method="post">
                    @csrf
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Portion Number" name="portion_id" required>
                    </div>

                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Name of Criteria" name="title" required>

                        <input style="margin-left: 5%;" type="text" class="form-control" name="percentage" placeholder="Percentage" required>
                        <label style="margin-top: 10px;"><b>%</b></label>
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
