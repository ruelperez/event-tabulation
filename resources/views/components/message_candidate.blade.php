
@if(session()->has('message_can'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_can')}}
    </div>
@endif

@if(session()->has('candidate_error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 4000)" class="alert alert-danger text-center pt-2" role="alert" style="height: 50px;">
        {{session('candidate_error')}}
    </div>

@endif

@if(session()->has('can_num_error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 4000)" class="alert alert-danger text-center pt-2" role="alert" style="height: 50px;">
        {{session('can_num_error')}}
    </div>
@endif

@if(session()->has('can_num_save'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 4000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
    {{session('can_num_save')}}
</div>
@endif






{{--@if(isset($message_can))--}}
{{--    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 2000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">--}}
{{--        {{$message_can}}--}}
{{--    </div>--}}

{{--@endif--}}
