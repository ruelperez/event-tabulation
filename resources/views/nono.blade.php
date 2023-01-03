@include('partial.header')

@php
$num = 1;
$end = 400;
$count = [];
while ($num <= $end){
    $count[$num] = $num;
    $num++;
    }
$num = 1;

@endphp

    @while($num <= $end)
    <div style="display: inline-block; margin-left: 5px;"><h2>{{$count[$num]}}</h2></div></div>
        @php
            $num++;
        @endphp

    @endwhile




@include('partial.footer')





