<div>
    <table class="table" style="width: 40%; margin-left: 30%; margin-top: 20px;">
        @foreach($portion_data as $data)
            <tr>
                <td>
                    <h5>{{ucwords($data->title)}}</h5>
                </td>

                <td style="text-align: center">
                    <a href="{{url('admin/result', ['eve_id' => $data->event_id, 'por_id' => $data->id])}}" target="_blank" style="cursor: pointer;">Result</a>
                </td>

                <td style="text-align: left">
                    @if($data->isLock == 0)
                        <i class="fas fa-lock-open" onclick="lock({{$data->id}})"></i>
                    @elseif($data->isLock == 1)
                        <i class="fas fa-lock" onclick="unlock({{$data->id}})"></i>
                    @endif
                </td>
            </tr>

        @endforeach
    </table>

</div>

<script>
    function lock(id) {
        if (confirm("Are you sure to lock this portion ??"))
            window.livewire.emit('emitLock', id);
    }

    function unlock(id) {
        if (confirm("Are you sure to unlock this portion ??"))
            window.livewire.emit('emitUnlock', id);
    }
</script>
