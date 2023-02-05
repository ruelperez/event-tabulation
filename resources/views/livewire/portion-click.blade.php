<div>
    <ul class="list-group" style="width: 100%; margin-top: 40px;" >
        @php $vp = 1; $sp = 1; @endphp
        @foreach($portionClick as $portionClicks)
            <li wire:ignore.self class="list-group-item btn" style="background-color: @if($sp == 1) aquamarine @else none @endif" id="style{{$sp}}" onclick="portionFetch({{$sp++}})">
                {{ucwords($portionClicks->title)}}
            </li>
            <input type="text" value="{{$vp++}}"  hidden>
        @endforeach
        <input type="text" id="porMax" value="{{$vp-1}}" hidden>
    </ul>
</div>
