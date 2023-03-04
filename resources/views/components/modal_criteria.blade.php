
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="criteria" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel" >Input Criteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex">
                <button style="width: 40%; margin-left: 10%; @if($bb == $shows->id) @else background-color: aquamarine; @endif border-color: wheat" wire:click="inputCriteria({{$shows->id}})">Input Criteria</button>
                <button style="width: 40%; margin-right: 10%;@if($dd == $shows->id) background-color: aquamarine; @else @endif border-color: wheat" wire:click="linkportionClicked({{$shows->id}})">Link to Portion</button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit_cri" @if($bb == $shows->id) hidden @endif>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="user_id" hidden>
                    </div>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="event_id" hidden>
                    </div>
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Portion Number" wire:model="portion_id" required hidden>
                    </div>
                    @error('portion_id') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Name of Criteria" wire:model="title_cri" required>
                        <input style="margin-left: 5%;" type="text" class="form-control" wire:model.debounce.500ms="percentage_cri" placeholder="Percentage" required>
                        <label style="margin-top: 10px;"><b>%</b></label>
                    </div>
                    @error('title_cri') <span style="color: red; margin-left: 2px;">{{ $message}}</span> @enderror
                    @error('percentage_cri') <span style="color: red; margin-left: 40%;">{{ $message}}</span> @enderror
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

                <form wire:submit.prevent="submit_linkPortion" @if($dd == $shows->id)  @else hidden @endif>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="user_id" required hidden>
                    </div>
                    <div class="mb-3" >
                        <input type="text" class="form-control" wire:model="event_id" required hidden>
                    </div>
                    <div class="mb-3 d-flex">
                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Portion Number" wire:model="portion_id" required hidden>
                    </div>
                    @error('portion_id') <span style="color: red; margin-left: 45%;">{{ $message}}</span> @enderror
                    <div class="mb-3 d-flex">
{{--                        <input style="margin-left: 5%; width: 800px;" type="text" class="form-control" placeholder="Name of Portion" wire:model="title_cri" required>--}}
                        <select class="form-select" aria-label="Default select example" wire:model="portionID_selectInput">
                            <option selected>Select Portion</option>
                            @foreach($show as $shows)
                                @if($event_id == $shows->event_id)
                                    <option value="{{$shows->id}}">{{$shows->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        <input style="margin-left: 5%;" type="text" class="form-control" wire:model.debounce.500ms="percentage_cri" placeholder="Percentage" required>
                        <label style="margin-top: 10px;"><b>%</b></label>
                    </div>
                    @error('title_cri') <span style="color: red; margin-left: 2px;">{{ $message}}</span> @enderror
                    @error('percentage_cri') <span style="color: red; margin-left: 40%;">{{ $message}}</span> @enderror
                    <div class="modal-footer">
                        @if(session()->has('linkSave'))
                            <div class="alert alert-success" style="width: 60%; ">
                                {{ session('linkSave') }}
                            </div>
                        @endif
                        @if(session()->has('linkUnsave'))
                            <div class="alert alert-danger" style="width: 60%; ">
                                {{ session('linkUnsave') }}
                            </div>
                        @endif

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="close_m">Close</button>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

