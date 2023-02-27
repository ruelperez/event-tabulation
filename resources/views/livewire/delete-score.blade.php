<div>
    <button type="button" class="btn btn-success" onclick="location.href='/admin/result/{{$eventID}}'" style="margin-top: 50px;margin-left: 2%;  width: 80%;">Result</button> <br>
{{--    <button type="button" class="btn btn-success" onclick="location.href='/admin/result'" style="margin-top: 10px;margin-left: 5%;  width: 15%;">Result</button>--}}
    <button class="btn btn-danger" style="margin-left: 1%;margin-top: 30px; width: 80%;" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete All Scores</button>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    @if(session()->has('deleted'))
                        <div class="alert alert-success" style="width: 60%; ">
                            {{ session('deleted') }}
                        </div>
                    @elseif(session()->has('failed'))
                        <div class="alert alert-danger" style="width: 60%; ">
                            {{ session('failed') }}
                        </div>
                    @else
                    <b>Delete all saved scores??</b>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteAll({{$eventID}})">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</div>
