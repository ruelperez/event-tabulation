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
        table();
    },1000);
    function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function (){
            document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/live-result");
        xhttp.send();



        let count_candidate = document.getElementById('count_candidate').value;
        let count_average = document.getElementById('count_average').value;
        let count_table = document.getElementById('count_table').value;
        let total = [];
        let rank1 = [];
        let rank2 = [];
        let rank3 = [];
        let rank4 = [];
        let average;
        for (let i = 1; i<=count_table; i++){

            for(let t = 1; t<=count_average; t++){
               let average = document.getElementById('final_average'+i+t).innerHTML;
               total[i+'_'+t] = average;
            }
        }

        let ave = count_average;
        let can = count_candidate;
        //Rank1
        for (let a = 1; a<=count_table; a++){

            for (let q=1; q<=can; q++){

                if (Number(total[a+'_'+q]) >= Number(total[a+'_'+ave])){
                    average = total[a+'_'+q];
                    ave = q;
                }
                else {
                    average = total[a+'_'+ave];
                }
                total[a+'_'+ave] = average;

            }
           rank1[a] = ave;
            ave = count_average;
            can = count_candidate;

        }

        ave = count_average;
        can = count_candidate;
        average = 0;
       // Rank2
        for (let a = 1; a<=count_table; a++){

            for (let q=1; q<=can; q++){

                if (rank1[a] == q){

                }
                else if(rank1[a] == can){
                    ave--;
                    can--;
                }
                else if(Number(total[a+'_'+rank1[a]]) == Number(total[a+'_'+q])){
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;
                    break;

                }
                else if(Number(total[a+'_'+rank1[a]]) > Number(total[a+'_'+q]) && Number(total[a+'_'+q]) >= Number(total[a+'_'+ave]) ){
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;
                }
                else if(Number(total[a+'_'+rank1[a]]) > Number(total[a+'_'+ave])){
                    average = total[a+'_'+ave];
                    total[a+'_'+ave] = average;

                }



            }
            rank2[a] = ave;
            ave = count_average;
            can = count_candidate;
        }



    //    Rank 3

        can = count_candidate
        ave = count_average
        average = 0;
        for (let a = 1; a<=count_table; a++){

            for (let q=1; q<=can; q++){

                if (rank2[a] == q || rank1[a] == q ){
               // console.log('1');
                }
                else if(rank1[a] == can || rank2[a] == can){
                   // console.log('2');
                    ave--;
                    can--;
                    q--;

                }
                else if(Number(total[a+'_'+rank2[a]]) == Number(total[a+'_'+q])){
                    //console.log('3');
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;
                    break;
                }
                else if(Number(total[a+'_'+rank2[a]]) > Number(total[a+'_'+q]) && Number(total[a+'_'+q]) >= Number(total[a+'_'+ave]) ){
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;
                    //console.log('4');

                }
                else if(Number(total[a+'_'+rank2[a]]) > Number(total[a+'_'+ave])){
                    //console.log('5');
                    average = total[a+'_'+ave];
                    total[a+'_'+ave] = average;
                    //console.log('haha');
                }



            }
            rank3[a] = ave;
            ave = count_average;
            can = count_candidate;
        }


           // Rank 4
        can = count_candidate
        ave = count_average
        average = 0;
        for (let a = 1; a<=count_table; a++){

            for (let q=1; q<=can; q++){

                if (rank2[a] == q || rank1[a] == q || rank3[a] == q ){

                }
                else if(rank1[a] == can || rank2[a] == can || rank3[a] == can){
                    ave--;
                    can--;
                    q--;
                }
                else if(Number(total[a+'_'+rank3[a]]) == Number(total[a+'_'+q])){
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;
                    break;
                }
                else if(Number(total[a+'_'+rank3[a]]) > Number(total[a+'_'+q]) && Number(total[a+'_'+q]) >= Number(total[a+'_'+ave]) ){
                    average = total[a+'_'+q];
                    ave = q;
                    total[a+'_'+ave] = average;

                }
                else if(Number(total[a+'_'+rank3[a]]) > Number(total[a+'_'+ave])){
                    average = total[a+'_'+ave];
                    total[a+'_'+ave] = average;
                }


            }
            rank4[a] = ave;
            ave = count_average;
            can = count_candidate;
        }





    }
</script>

<div id="table">

</div>


<script src="{{ asset('js/jqueryCdn.js') }}"></script>
{{--<script src="{{ asset('js/score_result.js')}}"></script>--}}
@include('partial.footer')
