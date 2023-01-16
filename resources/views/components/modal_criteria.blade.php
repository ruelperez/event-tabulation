
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="criteria">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Input Criteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="user_id">
                    </div>
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Portion Number" wire:model="portion_id" required>
                    </div>
                    @error('portion_id') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Name of Criteria" wire:model="title" required>
                        <input style="margin-left: 5%;" type="text" class="form-control" wire:model.debounce.500ms="percentage" placeholder="Percentage" required>
                        <label style="margin-top: 10px;"><b>%</b></label>
                    </div>
                    @error('title') <span style="color: red; margin-left: 2px;">{{ $message}}</span> @enderror
                    @error('percentage') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                    <div class="modal-footer">
                        @if(session()->has('criteriaSave'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('criteriaSave') }}
                            </div>
                        @endif
                            @if(session()->has('criteriaUnsave'))
                                <div class="alert alert-danger" style="width: 60%; ">
                                    {{ session('criteriaUnsave') }}
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
