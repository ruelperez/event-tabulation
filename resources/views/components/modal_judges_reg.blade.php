
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="reg_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Judges Registration Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reg-judges" method="post">
                @csrf
                    <div class="mb-3" hidden >
                        <input type="text" class="form-control" value="{{auth()->user()->id}}" name="user_id" required>
                    </div>
                    <div class="mb-3" hidden >
                        <input type="text" class="form-control" name="event_id" placeholder="Event Title Number"
                               @if(isset($eventID))
                                   value="{{$eventID}}"
                               @else
                                   value="null"
                               @endif >
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_name" placeholder="Full Name" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_username" name="username" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="id_pass" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="mb-3">
                        <label> Is Chairman:</label>
                        <label style="margin-left: 10px;">Yes</label>
                        <input type="radio" name="is_chairman" value="1" required>
                        <label style="margin-left: 10px;">No</label>
                        <input type="radio" name="is_chairman" value="0" required>

                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
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
