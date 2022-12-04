@if(session()->has('message_cri'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 2000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_cri')}}
    </div>
@endif

