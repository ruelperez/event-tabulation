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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
           background-color: #DCDCDC;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
    @livewireStyles
    @livewireScripts
</head>
<body>
    <div class="d-flex">
        <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()">&#9776; </span>
        <div class="container-fluid" style="background-color: darkblue; height: 94px;">
        </div>
    </div>

    <div id="mySidenav" class="sidenav" >
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style=" height: 94px; width: 80%; padding-left: 10px; color: white;">
            <h5>{{ucwords(auth()->user()->name)}}</h5> <h6>Admin #{{auth()->user()->id}}</h6>
            <form action="/admin/logout" method="POST">
                @csrf
                <button style="border: none; background-color: black; color:white; padding: 0px;font-size: 13px;">Logout</button>
            </form>
        </div>
        {{--    @livewire('portion-click')--}}
    </div>

    @livewire('assignment')



<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

@include('partial.footer')

