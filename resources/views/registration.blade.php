@include('partial.header')

<div class="d-flex">
    <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()">&#9776; </span>
    <div class="container-fluid" style="background-color: darkblue; height: 94px;">
        <h1 style="color: white; margin-left: 38%; margin-top: 15px; position: absolute">Event Tabulation</h1>
    </div>
</div>
<button type="button" class="btn btn-success" onclick="location.href = '/admin/event';" style="margin-left: 70px; margin-top: 15px;"><b>Back to Event List</b></button>
<button type="button" class="btn btn-warning" onclick="location.href = '/admin/result/{{$eventNUM}}';" style="margin-left: 10px; margin-top: 15px; width: 11%;"><b>Result</b></button>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style=" height: 94px; width: 80%; padding-left: 10px; color: white;">
        <h5>{{ucwords(auth()->user()->name)}}</h5> <h6>Admin #{{auth()->user()->id}}</h6>
        <form action="/admin/logout" method="POST">
            @csrf
            <button style="border: none; background-color: black; color:white; padding: 0px;font-size: 13px;">Logout</button>
        </form>
    </div>

</div>

    @livewire('admin-home',['eventNUM' => $eventNUM, 'regis' => $regis])


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

@include('partial.footer')


