
<div class="modal" tabindex="-1" role="dialog" id="title_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Event Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reg-title" method="post">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id_admin" value="{{auth()->user()->id}}" name="user_id" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Title" name="name" required>
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
