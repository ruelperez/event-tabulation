
<div wire:ignore.self class="modal fade" id="assign" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Fill Up Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <select class="form-select" wire:model="selectData" aria-label="Default select example" id="selectTech" style="width: 60%; color: black; background-color: #E6E6FA; text-align: center;margin-left: 20%; margin-bottom: 5%; margin-top: 3%;">
                        <option selected>Select Event</option>
                        @foreach($addEvent as $eve) { ?>
                        <option value="{{$eve->id}}">{{$eve->title}}</option>
                        @endforeach
                    </select>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




