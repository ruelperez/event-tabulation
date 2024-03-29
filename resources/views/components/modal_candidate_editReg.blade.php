
{{--edit candidate--}}
<div wire:ignore.self class="modal fade" id="editCandidate{{$v}}" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Fill Up Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="edit_submit" style="margin-top: 10px;">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="event_id" placeholder="Event Title Number">
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="user_id">
                    </div>
                    <div class="mb-3">
                        @if(session()->has('idInputError'))
                            <span style="color: red; margin-bottom: 1px; font-size: 15px;">{{session('idInputError')}}</span>
                        @endif
                        @error('candidate_number')<span style="color: red">{{ $message }}</span> @enderror
                        <input type="text" class="form-control" wire:model="candidate_number" placeholder="Candidate No." required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="full_name" placeholder="Full Name / Team Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="origin" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        @if($anti == 1)
                            <img src="{{asset('storage/'.$image)}}" width="200">
                        @else
                            <img src={{$image}} width="200">
                        @endif
                        <label>Photo</label>
                        <input type="file" id="editcan{{$v}}" wire:change="$emit('editCandidate',{{$v}})" class="form-control">
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('dataAdded'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('dataAdded') }}
                            </div>
                        @endif
                        @if(session()->has('dataError'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('dataError') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
