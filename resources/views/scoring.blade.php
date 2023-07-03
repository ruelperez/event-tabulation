<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>
    </title>
    <link rel="stylesheet" href="css/main.css>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    @livewireScripts
    <script src="{{ asset('js/jqueryCdn.js') }}"></script>
</head>
<body onload="myFunction()">


<button type="button" class="btn btn-primary" style="margin-top: 1%; margin-left: 7%; width: 10%;" onclick="location.href = '/judge/event'">Event List</button>
{{--@include('components.score_submit_modal')--}}
    @livewire('show-scoring', ['eventID' => $eventID])

<script src="{{ asset('css/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('css/bootstrap.min.js') }}"></script>
</body>
</html>

