
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="portion_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Portion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    @csrf
                    <div class="mb-3"  hidden>
                        <input type="text" class="form-control" wire:model="event_id" placeholder="Event Title Number" required>
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="user_id" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Portion Name" wire:model="title" required>
                    </div>

                    <input type="checkbox" value="2" wire:model="checkTop">
                    <label> Number of Top List</label><br>
                    @if($checkTop == 2)
                        <input type="text" wire:model="numberOfTopCandidate">
                        @error('numberOfTopCandidate') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                        <br>
                    @endif

                    <input type="checkbox" value="1" wire:model="checkbox">
                    <label> Number of candidate to be rate</label><br>
                    @if($checkbox == 1)
                    <input type="text" wire:model="numberOfCandidate">
                    @error('numberOfCandidate') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
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


