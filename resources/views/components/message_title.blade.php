@if(session()->has('message_title'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_title')}}
    </div>
@endif

@if(session()->has('message_title_error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-warning text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_title_error')}}
    </div>
@endif



