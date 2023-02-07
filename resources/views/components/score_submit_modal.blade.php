<!-- Modal -->
<div wire:ignore.self class="modal fade" id="btnModal{{$x}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($bbm == 1)
                    <div class="alert alert-success" style="width: 60%; ">
                        <h6>Successfully Saved</h6>
                    </div>
                @else
                Are you sure you want to submit? <br>
                The score will become irrevocable once submitted.
                @endif
            </div>
            <div class="modal-footer">
                @if ($bbm == 1)
                    <button type="button" class="btn btn-secondary" onclick="exitModal()" data-bs-dismiss="modal">Close</button>
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="submitModal({{$portions->id}},{{Auth::guard('webjudge')->user()->id}})">Proceed</button>
                @endif

            </div>
        </div>
    </div>
</div>
