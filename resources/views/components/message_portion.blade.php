@if(session()->has('message_portion'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_portion')}}
    </div>
@endif

