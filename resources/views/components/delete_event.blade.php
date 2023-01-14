<div class="modal fade" id="delete_event{{$shows->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h6>Are you sure, you want to delete {{strtoupper($shows->title)}}???</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" wire:click="delete({{$shows->id}})" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
