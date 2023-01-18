@include('partial.header')
<h4>{{Auth::guard('webjudge')->user()->id}}</h4> <h4>{{Auth::guard('webjudge')->user()->full_name}}</h4>
<form action="/judge/logout" method="POST">
    @csrf
    <button style="margin-left: 93%; width: 6%;">logout</button>
</form>

    @livewire('show-scoring')


@include('partial.footer')
