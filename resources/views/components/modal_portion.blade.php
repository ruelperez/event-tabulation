
<div class="modal" tabindex="-1" role="dialog" id="portion_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Portion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reg-portion" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Event Title Number" name="event_id" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Portion Name" name="title" required>
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
