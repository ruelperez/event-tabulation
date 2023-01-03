@if(session()->has('message_can'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 3000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">
        {{session('message_can')}}
    </div>
@endif

{{--@if(isset($message_can))--}}
{{--    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false, 2000)" class="alert alert-success text-center pt-2" role="alert" style="height: 50px;">--}}
{{--        {{$message_can}}--}}
{{--    </div>--}}

{{--@endif--}}
