@include('partial.header')

<div class="d-flex">
    <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()">&#9776; </span>
    <div class="container-fluid" style="background-color: darkblue; height: 94px;">
    </div>
</div>

<div id="mySidenav" class="sidenav" >
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style=" height: 94px; width: 80%; padding-left: 10px; color: white;">
        <h5>{{ucwords(Auth::guard('webjudge')->user()->full_name)}}</h5> <h6>Judge #{{Auth::guard('webjudge')->user()->judge_number}}</h6>
        <form action="/admin/logout" method="POST">
            @csrf
            <button style="border: none; background-color: black; color:white; padding: 0px;font-size: 13px;">Logout</button>
        </form>
    </div>
    {{--    @livewire('portion-click')--}}
</div>
<div class="border border-primary" style="margin-left: 25%; width: 50%; margin-top: 3%;">
    <div class="bg-primary text-center pt-2" style="width:97%; height: 50px; margin-left: 3%; margin-top: 50px;"><h4>Event Title</h4></div>
    @livewire('judge-event')

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
