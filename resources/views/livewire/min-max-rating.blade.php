<div style="margin-top: 10%; margin-left: 24%">
    @if(session()->has('success'))
        <div class="alert alert-success" style="width: 60%; ">
            {{ session('success') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger" style="width: 60%; ">
            {{ session('error') }}
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <input style="width: 15%;" type="text" placeholder="Min" wire:model="min" required> -
        <input style="width: 15%;" type="text" placeholder="Max" wire:model="max" required>
        <button type="submit" class="btn btn-primary" style="width: 30%; margin-left: 3%;">Submit</button>
    </form>

    @foreach($data as $datas)
        <div style="margin-top: 10%; margin-left: 20%;">
            <h2>{{$datas->min}} - {{$datas->max}}</h2>
        </div>

    @endforeach

</div>
