
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="title_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="updateModalLabel" >Event Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id_admin" wire:model="user_id">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Name of the Title" wire:model.debounce.500ms="name">
                    </div>
                    @error('name') <span style="color: red">{{ $message }}</span> @enderror

                    <div class="modal-footer">
                        @if (session()->has('evntError'))
                            <div class="alert alert-danger" style="width: 60%;">
                                {{ session('evntError') }}
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success" style="width: 60%;">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('error') }}
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


{{--EDIT TITLE EVENT--}}
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="editTitle_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="insertModalLabel" >Event Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="editSubmit">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id_admin" wire:model="user_id">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_title" placeholder="Name of the Title" wire:model.debounce.500ms="name">
                    </div>
                    @error('name') <span style="color: red">{{ $message }}</span> @enderror

                    <div class="modal-footer">
                        @if (session()->has('editSave'))
                            <div class="alert alert-success" style="width: 60%;">
                                {{ session('editSave') }}
                            </div>
                        @endif
                        @if (session()->has('editError'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('editError') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

