
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="edit_award{{$m}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" ><b>{{ucwords($portion_name)}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit_edit">
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="user_id" required hidden>
                    </div>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="event_id" required hidden>
                    </div>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="portion_id" required hidden>
                    </div>

                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%;" type="text" class="form-control" wire:model="award_name" placeholder="Name of Award" required>
                    </div>
                    {{--                    @error('title_cri') <span style="color: red; margin-left: 2px;">{{ $message}}</span> @enderror--}}
                    {{--                    @error('percentage_cri') <span style="color: red; margin-left: 40%;">{{ $message}}</span> @enderror--}}
                    <div class="modal-footer">
                        @if(session()->has('awardEdited'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('awardEdited') }}
                            </div>
                        @endif
                        @if(session()->has('awardFailed'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('awardFailed') }}
                            </div>
                        @endif

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="close">Close</button>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


