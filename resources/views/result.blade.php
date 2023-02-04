<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles.css">
    <title>
    </title>
    <link rel="stylesheet" href="css/main.css>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    @livewireScripts
</head>
<body onload="table()">
<div class="d-flex">
    <div style="border: solid darkblue; height: 94px; width: 15%; padding-left: 10px;">
        <h5>Admin #{{auth()->user()->id}}</h5> <h6>{{ucwords(auth()->user()->name)}}</h6>
        <form action="/admin/logout" method="POST">
            @csrf
            <button style="border: none; background-color: white; color: blue; padding: 0px;font-size: 15px;">Logout</button>
        </form>
    </div>
    <div class="container-fluid" style="background-color: darkblue; height: 94px;padding-left: 31%; padding-top: 12px;">
        <h1 style="color: white;">Event Tabulation</h1>
    </div>
</div>

<button type="button" class="btn btn-outline-success" onclick="location.href='/admin/home'" style="margin-top: 10px;margin-left: 1%; width: 8%; height: 40px;">Home</button>
<button type="button" class="btn btn-outline-success" onclick="location.href='/admin/result'" style="margin-top: 10px;margin-left: 1%; width: 8%; height: 40px;">Result</button>

<script type="text/javascript">
    setInterval(function (){
        table()
    },1000);
    function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function (){
            document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/live-result");
        xhttp.send();
    }
</script>

<div id="table">

</div>

{{--<script src="{{ asset('js/jqueryCdn.js') }}"></script>--}}
{{--<script src="{{ asset('js/score_result.js')}}"></script>--}}
@include('partial.footer')
