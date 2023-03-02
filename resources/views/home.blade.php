@include('partial.header')

<div class="d-flex">
    <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()">&#9776; </span>
    <div class="container-fluid" style="background-color: darkblue; height: 94px;">
        <h1 style="color: white; margin-left: 38%; margin-top: 15px; position: absolute">Event Tabulation</h1>
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

    <div class="border border-primary" style="margin-left: 20%; width: 60%; margin-top: 15px;">
        <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%; margin-top: 50px;"><h4>Event Title</h4></div>
        <span class="btn" data-bs-toggle="modal" data-bs-target="#title_modal" id="boot-icon" class="bi bi-plus-circle-fill" style="font-size: 42px; color: rgb(165, 42, 42);margin-left: 45%;">+</span>
        @livewire('show-title')

    </div>


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

@include('partial.footer')
