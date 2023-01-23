
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="reg_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Judges Registration Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="mb-3" hidden >
                        <input type="text" class="form-control" wire:model="user_id">
                    </div>
                    <div class="mb-3" hidden >
                        <input type="text" class="form-control" wire:model="event_id">
                    </div>
                    @error('judge_number') <span style="color: red">{{ $message }}</span> @enderror
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Judge No." wire:model.debounce.500ms="judge_number" required>
                    </div>
                    @error('full_name') <span style="color: red">{{ $message }}</span> @enderror
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_name" placeholder="Full Name" wire:model.debounce.500ms="full_name" required>
                    </div>
                    @error('username') <span style="color: red">{{ $message }}</span> @enderror
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id_username" wire:model.debounce.500ms="username" placeholder="Username" required>
                    </div>
                    @error('password') <span style="color: red">{{ $message }}</span> @enderror
                    <div class="mb-3">
                        <input type="password" class="form-control" id="id_pass" wire:model.debounce.500ms="password" placeholder="Password" required>
                    </div>
                    @error('password_confirmation') <span style="color: red">{{ $message }}</span> @enderror
                    <div class="mb-3">
                        <input type="password" class="form-control" wire:model.debounce.500ms="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="mb-3">
                        <label> Is Chairman:</label>
                        <input type="checkbox" wire:model="is_chairman">

                    </div>
                    <div class="mb-3">
                        <img src={{$image}} width="200">

                        <label>Photo</label>
                        <input type="file" id="judge_photo" wire:change="$emit('fileChoose')" class="form-control">
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('regError'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('regError') }}
                            </div>
                        @endif
                        @if(session()->has('data_save'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('data_save') }}
                            </div>
                        @endif
                        @if(session()->has('data_unsave'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('data_unsave') }}
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
