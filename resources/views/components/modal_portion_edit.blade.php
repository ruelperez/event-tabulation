<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="editPortion{{$d}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Portion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submitEdit">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="event_id" placeholder="Event Title Number">
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="user_id">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Portion Name" wire:model="title" required>
                    </div>

                    @if($numberOfTopCandidate != 0)
                        <label>Number of Candidate to be Rate</label> <br>
                        <label>Top</label> <input type="text" wire:model="numberOfTopCandidate">
                        @error('numberOfTopCandidate') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                    @endif

                    <div class="modal-footer">
                        @if(session()->has('portionSave'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('portionSave') }}
                            </div>
                        @endif
                        @if(session()->has('portionError'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('portionError') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
