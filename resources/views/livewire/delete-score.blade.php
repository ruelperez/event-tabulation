<div>
    <button type="button" class="btn btn-success" onclick="history.back()" style="width: 10%; margin-left: 74px; height: 40px;">Back</button>
    <button class="btn btn-danger" style="margin-left: 1%; width: 10%;" data-bs-toggle="modal" data-bs-target="#exampleModals">Delete All Scores</button>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    @if(session()->has('deleted'))
                        <div class="alert alert-success" style="width: 60%; ">
                            {{ session('deleted') }}
                        </div>
                    @elseif(session()->has('failed'))
                        <div class="alert alert-danger" style="width: 60%; ">
                            {{ session('failed') }}
                        </div>
                    @else
                    <b>Delete all saved scores??</b>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteAll({{$eventID}})">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</div>
