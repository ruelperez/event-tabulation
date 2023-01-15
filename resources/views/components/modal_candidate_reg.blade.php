
<div wire:ignore.self class="modal fade" id="can_reg" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Fill Up Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" x-data="{show : false, appear : false}">
                <div class="row text-center" style="height: 40px;" >
                    <div class="divs col border border-primary btn"  @click="show = true, appear = false" style="padding-top: 5px; ">Individual</div>
                    <div class="col border border-primary btn" @click="appear = true, show = false" style="padding-top: 5px; ">Group</div>
                </div>

                <form wire:submit.prevent="submit" x-show="show" style="margin-top: 10px;">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="event_id" placeholder="Event Title Number">
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="user_id">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="candidate_id" placeholder="Candidate No." required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" wire:model="team_name" placeholder="Team Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="origin" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <img src={{$image}} width="200">

                        <label>Photo</label>
                        <input type="file" id="image" wire:change="$emit('fileChoosen')" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <form action="/reg-candidate" method="POST" x-show="appear" style="margin-top: 10px;">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" name="event_id" placeholder="Event Title Number"
                               @if(isset($eventID))
                                   value="{{$eventID}}"
                               @else
                                   value="null"
                                @endif >
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" value="{{auth()->user()->id}}" name="user_id"  required>
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" name="full_name" value="null" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="id" placeholder="Team No." required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="team_name" placeholder="Team Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="origin" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--<script>--}}
{{--    window.livewire.on('fileChoosen', ()=>{--}}
{{--        let inputfield = document.getElementById('#image')--}}
{{--        let file = inputfield.files[0]--}}
{{--        let reader = new FileReader();--}}
{{--        reader.onloadend = () => {--}}
{{--            window.livewire.emit('fileUpload', reader.result)--}}
{{--        }--}}

{{--        reader.readAsDataURL(file);--}}
{{--    })--}}
{{--</script>--}}
</div>

