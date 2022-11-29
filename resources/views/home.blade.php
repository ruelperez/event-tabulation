@include('partial.header')
<div class="container-fluid" style="background-color: darkblue; height: 70px; text-align: center; padding: 10px;">
    <h1 style="color: white">Event Tabulation</h1>
</div>


<div class="container justify-content-between d-flex" style="margin-top: 50px">

    <div class="my-auto " style="height: 50px; width: 50px;" ><a class="btn btn-primary py-1" href="/judges-reg" target = '_blank' role="button" style="height: clamp(23px,3vw,10rem); width: clamp(85px,15vw,20rem);"><h3 class="text-center" style="font-size: clamp(11px,1.2vw,2.5rem);"  >Judges Registration</h3></a></div>
    <div class="my-auto"><a class="btn btn-primary py-1" href="/candidate-reg" target = '_blank' role="button" style="height: clamp(23px,3vw,10rem); width: clamp(85px,15vw,20rem);"><h3 class="text-center" style="font-size: clamp(11px,1.2vw,2.5rem);">Candidate Registration</h3></a></div>
    <div class="my-auto">
        <a class="btn btn-primary py-1" href="/criteria" target = '_blank' role="button" style="height: clamp(23px,3vw,10rem); width: clamp(85px,15vw,20rem);"><h3 class="text-center" style="font-size: clamp(11px,1.2vw,2.5rem);">Criteria</h3></a>
    </div>
</div>







@include('partial.footer')
