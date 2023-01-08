@if(session()->has('message_jud'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_jud')}}
    </div>
@endif

@if(session()->has('judge_error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 4000)" class="alert alert-danger text-center pt-2" role="alert" style="height: 50px;">
        {{session('judge_error')}}
    </div>
@endif



