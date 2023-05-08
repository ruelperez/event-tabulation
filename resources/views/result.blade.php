<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>
        {{$title}}
    </title>
    <link rel="stylesheet" href="css/main.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: "Lato", sans-serif;
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

        @media print {
            #nav,
            .container-fluid,
            #print,
            #save{
                display: none;
            }

            .tb{
               margin-bottom: 650px;
            }
        }


    </style>
</head>
<body onload="table()" id="body">

<div class="d-flex" id="head">
    <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()" id="nav">&#9776; </span>
    <div class="container-fluid" style="background-color: darkblue; height: 94px; margin-bottom: 30px;">
{{--        <h2 style="color: white; margin-left: 38%; margin-top: 15px; position: absolute; font-style: italic"></h2>--}}
    </div>
</div>

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
<input type="text" id="ty" value="{{$porID}}" hidden>
<script type="text/javascript">
  setInterval(function (){
        table();
    },1000);


  function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
  }
    function table() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            document.getElementById("table").innerHTML = this.responseText;
            ert();
        }
        let porID = document.getElementById('ty').value;
        xhttp.open("GET", "/admin/live-result/"+porID);
        xhttp.send();

    }
    function ert(){
        let count_candidate = document.getElementById('count_candidate').value;
        let count_average = document.getElementById('count_average').value;
        let count_table = document.getElementById('count_table').value;
        let total = [];
        let rank = [];
        let average;
        let xy = 1;
        let rank_number = 1;
        let count_can = document.getElementById('count_candidate').value;


        for (let i = 1; i<=count_table; i++){

            for(let t = 1; t<=count_average; t++){
                let average = document.getElementById('final_average'+i+t).innerHTML;
                total[i+'_'+t] = average;
            }
        }

        if (xy<=count_can){
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
                rank[rank_number+'_'+a] = ave;
                ave = count_average;
                can = count_candidate;
            }

        }

        xy++;
        if (xy<=count_can){

            ave = count_average;
            can = count_candidate;
            average = 0;
            // Rank2
            for (let a = 1; a<=count_table; a++){

                for (let q=1; q<=can; q++){

                    if (rank[rank_number+'_'+a] == q){

                    }
                    else if(rank[rank_number+'_'+a] == can){
                        ave--;
                        can--;
                        q--;
                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) == Number(total[a+'_'+q])){
                        average = total[a+'_'+q];
                        ave = q;
                        total[a+'_'+ave] = average;
                        break;

                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) > Number(total[a+'_'+q]) && Number(total[a+'_'+q]) >= Number(total[a+'_'+ave]) ){
                        average = total[a+'_'+q];
                        ave = q;
                        total[a+'_'+ave] = average;
                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) > Number(total[a+'_'+ave])){
                        average = total[a+'_'+ave];
                        total[a+'_'+ave] = average;

                    }


                }
                rank_number++;
                rank[rank_number+'_'+a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }
        }

        rank_number++;

        xy++;

        if (xy<=count_can){
            //    Rank 3
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a<=count_table; a++){

                for (let q=1; q<=can; q++){

                    if (rank[rank_number+'_'+a] == q || rank[rank_number-1+'_'+a] == q ){

                    }
                    else if(rank[rank_number+'_'+a] == can || rank[rank_number-1+'_'+a] == can){
                        ave--;
                        can--;
                        q--;

                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) == Number(total[a+'_'+q])){
                        average = total[a+'_'+q];
                        ave = q;
                        total[a+'_'+ave] = average;
                        break;
                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) > Number(total[a+'_'+q]) && Number(total[a+'_'+q]) >= Number(total[a+'_'+ave]) ){
                        average = total[a+'_'+q];
                        ave = q;
                        total[a+'_'+ave] = average;

                    }
                    else if(Number(total[a+'_'+rank[rank_number+'_'+a]]) > Number(total[a+'_'+ave])){
                        average = total[a+'_'+ave];
                        total[a+'_'+ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number+'_'+a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 4
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 5
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 6
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 7
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }


        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 8
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 9
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }


        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 10
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 11
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q || rank[rank_number - 9 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can || rank[rank_number - 9 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }


        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 12
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q || rank[rank_number - 9 + '_' + a] == q || rank[rank_number - 10 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can || rank[rank_number - 9 + '_' + a] == can || rank[rank_number - 10 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 13
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q || rank[rank_number - 9 + '_' + a] == q || rank[rank_number - 10 + '_' + a] == q || rank[rank_number - 11 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can || rank[rank_number - 9 + '_' + a] == can || rank[rank_number - 10 + '_' + a] == can || rank[rank_number - 11 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }


        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 14
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q || rank[rank_number - 9 + '_' + a] == q || rank[rank_number - 10 + '_' + a] == q || rank[rank_number - 11 + '_' + a] == q || rank[rank_number - 12 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can || rank[rank_number - 9 + '_' + a] == can || rank[rank_number - 10 + '_' + a] == can || rank[rank_number - 11 + '_' + a] == can || rank[rank_number - 12 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }


        rank_number++;

        xy++;

        if (xy<=count_can) {
            //    Rank 15
            can = count_candidate
            ave = count_average
            average = 0;
            for (let a = 1; a <= count_table; a++) {

                for (let q = 1; q <= can; q++) {

                    if (rank[rank_number + '_' + a] == q || rank[rank_number - 1 + '_' + a] == q || rank[rank_number - 2 + '_' + a] == q || rank[rank_number - 3 + '_' + a] == q || rank[rank_number - 4 + '_' + a] == q || rank[rank_number - 5 + '_' + a] == q || rank[rank_number - 6 + '_' + a] == q || rank[rank_number - 7 + '_' + a] == q || rank[rank_number - 8 + '_' + a] == q || rank[rank_number - 9 + '_' + a] == q || rank[rank_number - 10 + '_' + a] == q || rank[rank_number - 11 + '_' + a] == q || rank[rank_number - 12 + '_' + a] == q || rank[rank_number - 13 + '_' + a] == q) {

                    } else if (rank[rank_number + '_' + a] == can || rank[rank_number - 1 + '_' + a] == can || rank[rank_number - 2 + '_' + a] == can || rank[rank_number - 3 + '_' + a] == can || rank[rank_number - 4 + '_' + a] == can || rank[rank_number - 5 + '_' + a] == can || rank[rank_number - 6 + '_' + a] == can || rank[rank_number - 7 + '_' + a] == can || rank[rank_number - 8 + '_' + a] == can || rank[rank_number - 9 + '_' + a] == can || rank[rank_number - 10 + '_' + a] == can || rank[rank_number - 11 + '_' + a] == can || rank[rank_number - 12 + '_' + a] == can || rank[rank_number - 13 + '_' + a] == can) {
                        ave--;
                        can--;
                        q--;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) == Number(total[a + '_' + q])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;
                        break;
                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + q]) && Number(total[a + '_' + q]) >= Number(total[a + '_' + ave])) {
                        average = total[a + '_' + q];
                        ave = q;
                        total[a + '_' + ave] = average;

                    } else if (Number(total[a + '_' + rank[rank_number + '_' + a]]) > Number(total[a + '_' + ave])) {
                        average = total[a + '_' + ave];
                        total[a + '_' + ave] = average;

                    }

                }
                rank_number++;
                rank[rank_number + '_' + a] = ave;
                ave = count_average;
                can = count_candidate;
                rank_number--;
            }

        }

        can = count_candidate
        ave = count_average
        average = 0;
        let za =1;
        let scr;
        let cge = [];
        let top_Can = document.getElementById('top_CAN').value;
        // console.log(top_Can)
        let fv = 1;
        let hn = 0;
        let op = 0;
        let yh = 0;
        let div_body = document.getElementById('divBody');
        let tbl = document.getElementById('tbl');
        let n = document.getElementById('count_award').value;
        let zs = document.getElementById('quantityToRate').value;
        let ty = 0;
        let gy=0;

        for (let i = 1; i<=count_table; i++){

            for(let t = 1; t<=count_can; t++){
                if (t == 1){
                    scr = "st";
                }
                else if(t==2){
                    scr="nd";
                }
                else if (t==3){
                    scr = "rd";
                }
                else{
                    scr="th";
                }

                let rn = rank[t+'_'+i];
                let row_select = document.getElementById('candidate_row'+i+rn);

                a();

                function a(){
                    if (n > gy){
                        row_select.style.backgroundColor = "#AFEEEE";
                        let g = document.getElementById('img'+i+rn).src;
                        let z = document.getElementById('award'+gy).value;
                        let gh = document.getElementById('fullname'+i+rn).innerText;
                        let h = document.getElementById('origin'+i+rn).innerText;

                        let w = row_select.cells[0].innerText;
                        let sa = document.getElementById('divBody');
                        let p = document.createElement("div");
                        p.style.backgroundColor = "#AFEEEE";
                        p.style.width = "40%";
                        p.style.marginLeft = "30%";
                        p.style.marginBottom = "15px";
                        let s = document.createElement("img");
                        let sp = document.createElement("h2");
                        let ss = document.createElement("h3");
                        let pp = document.createElement("h4");
                        let hp = document.createElement("h5");
                        let uj = document.createElement("div");

                        uj.style.width = "94%";
                        uj.style.height = "20px";
                        uj.style.marginLeft = "3%";
                        uj.style.marginBottom = "15px";
                        uj.style.backgroundColor = "darkblue";

                        hp.style.textTransform = "capitalize";
                        hp.style.textAlign = "center";
                        hp.innerHTML = h;
                        pp.style.textTransform = "capitalize";
                        pp.style.textAlign = "center";
                        pp.innerHTML = gh;
                        ss.innerHTML = "Candidate #"+ w;
                        ss.style.textTransform = "capitalize";
                        ss.style.textAlign = "center";
                        sp.innerHTML = z;
                        sp.style.textTransform = "capitalize";
                        sp.style.textAlign = "center";
                        s.style.width = "30%";
                        s.style.height = "30%";
                        s.style.borderRadius = "50%";
                        s.style.marginLeft = "35%";
                        s.style.marginBottom = "10px";
                        s.src = g;
                        p.appendChild(sp);
                        p.appendChild(s);
                        p.appendChild(ss);
                        p.appendChild(pp);
                        p.appendChild(hp);
                        sa.appendChild(p);
                        sa.appendChild(uj);
                        gy++;

                    }
                }

                b();
                function b(){
                    if (top_Can > ty ){
                        row_select.style.backgroundColor = "#AFEEEE";
                        let gh = document.getElementById('fullname'+i+rn).innerText;
                        let g = document.getElementById('img'+i+rn).src;
                        let w = row_select.cells[0].innerText;

                        let s = document.createElement("img");
                        let sa = document.getElementById('divBody');
                        let p = document.createElement("div");
                        let ss = document.createElement("h2");
                        let pp = document.createElement("h3");
                        let uj = document.createElement("div");


                        s.style.width = "30%";
                        s.style.height = "120px";
                        s.style.marginLeft = "35%";
                        s.style.marginBottom = "5px";
                        s.style.borderRadius= "50%"
                        s.src = g;

                        p.style.width = "40%";
                        p.style.marginLeft = "30%";
                        p.style.marginBottom = "70px";
                        p.style.borderRadius= "50%"



                        pp.style.textTransform = "capitalize";
                        pp.style.textAlign = "center";
                        pp.innerHTML = gh;
                        ss.innerHTML = "Candidate #"+ w;
                        ss.style.textTransform = "capitalize";
                        ss.style.textAlign = "center";

                        p.appendChild(s);
                        p.appendChild(ss);
                        p.appendChild(pp);
                        sa.appendChild(p);
                        ty++;
                    }
                }

                c();
                function c(){
                    if (top_Can == 0 && zs == 0 && n == 0 && yh == 0 ){
                        row_select.style.backgroundColor = "#AFEEEE";
                        yh++;
                    }
                }

                ds();
                function ds(){
                    if (top_Can == 0 && zs > 0 && n == 0 && hn == 0){
                        row_select.style.backgroundColor = "#AFEEEE";
                        hn++;
                    }
                }




                // if (top_Can == 0 && zs == 0 && n > op){
                //     row_select.style.backgroundColor = "#AFEEEE";
                //         let g = document.getElementById('img'+i+rn).src;
                //         let z = document.getElementById('award'+op).value;
                //         let gh = document.getElementById('fullname'+i+rn).innerText;
                //         let h = document.getElementById('origin'+i+rn).innerText;
                //
                //         let w = row_select.cells[0].innerText;
                //         let sa = document.getElementById('divBody');
                //         let p = document.createElement("div");
                //         p.style.backgroundColor = "#AFEEEE";
                //         p.style.width = "40%";
                //         p.style.marginLeft = "30%";
                //         p.style.marginBottom = "100px";
                //         let s = document.createElement("img");
                //         let sp = document.createElement("h1");
                //         let ss = document.createElement("h2");
                //         let pp = document.createElement("h3");
                //         let hp = document.createElement("h4");
                //         hp.style.textTransform = "capitalize";
                //         hp.style.textAlign = "center";
                //         hp.innerHTML = h;
                //         pp.style.textTransform = "capitalize";
                //         pp.style.textAlign = "center";
                //         pp.innerHTML = gh;
                //         ss.innerHTML = "Candidate #"+ w;
                //         ss.style.textTransform = "capitalize";
                //         ss.style.textAlign = "center";
                //         sp.innerHTML = z;
                //         sp.style.textTransform = "capitalize";
                //         sp.style.textAlign = "center";
                //         s.style.width = "30%";
                //         s.style.height = "30%";
                //         s.style.borderRadius = "50%";
                //         s.style.marginLeft = "35%";
                //         s.style.marginBottom = "30px";
                //         s.src = g;
                //         p.appendChild(sp);
                //         p.appendChild(s);
                //         p.appendChild(ss);
                //         p.appendChild(pp);
                //         p.appendChild(hp);
                //         sa.appendChild(p);
                //     op++;
                //
                // }
                // else if (top_Can == 0 && zs == 0 && n == 0 && yh == 0){
                //     row_select.style.backgroundColor = "#AFEEEE";
                //     yh++;
                // }
                // else if (top_Can > 0 && zs == 0 && top_Can >= fv){
                //     row_select.style.backgroundColor = "#AFEEEE";
                //     fv++;
                //
                //     let sa = document.getElementById('divBody');
                //     let p = document.createElement("div");
                //     let fr = document.createElement("h4");
                //     let fs = document.createElement("h3");
                //     let io = row_select.cells[0].innerText;
                //     let gh = document.getElementById('fullname'+i+rn).innerText;
                //     fs.style.textTransform = "capitalize";
                //     fs.style.textAlign = "center";
                //     fs.innerHTML = "Candidate #"+io;
                //     fr.style.textTransform = "capitalize";
                //     fr.style.textAlign = "center";
                //     fr.innerHTML = gh;
                //     p.appendChild(fs);
                //     p.appendChild(fr);
                //     sa.appendChild(p);
                //
                // }
                // else if(top_Can == 0 && zs > 0 && n > hn){
                //     row_select.style.backgroundColor = "aquamarine";
                //     let g = document.getElementById('img'+i+rn).src;
                //     let z = document.getElementById('award'+hn).value;
                //     let gh = document.getElementById('fullname'+i+rn).innerText;
                //     let h = document.getElementById('origin'+i+rn).innerText;
                //
                //     let w = row_select.cells[0].innerText;
                //     let sa = document.getElementById('divBody');
                //     let p = document.createElement("div");
                //     p.style.backgroundColor = "#AFEEEE";
                //     p.style.width = "40%";
                //     p.style.marginLeft = "30%";
                //     p.style.marginBottom = "100px";
                //     let s = document.createElement("img");
                //     let sp = document.createElement("h1");
                //     let ss = document.createElement("h2");
                //     let pp = document.createElement("h3");
                //     let hp = document.createElement("h4");
                //     hp.style.textTransform = "capitalize";
                //     hp.style.textAlign = "center";
                //     hp.innerHTML = h;
                //     pp.style.textTransform = "capitalize";
                //     pp.style.textAlign = "center";
                //     pp.innerHTML = gh;
                //     ss.innerHTML = "Candidate #"+ w;
                //     ss.style.textTransform = "capitalize";
                //     ss.style.textAlign = "center";
                //     sp.innerHTML = z;
                //     sp.style.textTransform = "capitalize";
                //     sp.style.textAlign = "center";
                //     s.style.width = "30%";
                //     s.style.height = "30%";
                //     s.style.borderRadius = "50%";
                //     s.style.marginLeft = "35%";
                //     s.style.marginBottom = "30px";
                //     s.src = g;
                //     p.appendChild(sp);
                //     p.appendChild(s);
                //     p.appendChild(ss);
                //     p.appendChild(pp);
                //     p.appendChild(hp);
                //     sa.appendChild(p);
                //     hn++;
                // }
                // else if(top_Can == 0 && zs > 0 && n == 0 && ty==0){
                //     row_select.style.backgroundColor = "aquamarine";
                //     ty++;
                // }

                let node = document.createElement("td");
                let textnode = document.createTextNode(t+scr);
                node.appendChild(textnode);
                row_select.appendChild(node);

                cge[i+'_'+t] = document.getElementById('final_average'+i+rn).innerHTML;

                // let kol = document.getElementById('link'+t);
                // if (kol != null){
                //     if(za <= kol.value){
                //        let cge = document.getElementById('final_average'+t+rn);
                //        cge.style.backgroundColor = "yellow";
                //     }
                // }
                // else if(za == 1){
                //     let cge = document.getElementById('final_average'+t+rn);
                //     cge.style.backgroundColor = "yellow";
                // }

            }
            za++;
        }

        let u = 1;
        let d=0;
        let common = [];
        let r = 1;
        let j = 1;

        for (let table = 1; table<=count_table; table++){

            for (let can = 1; can<=count_can; can++){

                for (let cans =1; cans<=count_can; cans++){

                    if (cge[table+'_'+can] == cge[table+'_'+cans]){

                        if (can != cans){
                                common[table+'_'+j] = cge[table+'_'+can];
                                j++;
                            }
                        }

                    }
                }
            j = 1;
            }

        for (let qwe = 1; qwe<=count_table; qwe++){

            for (let yg = 1; yg<=count_can; yg++){

                for (let mas = 1; mas<=count_can; mas++){

                    let rn =  document.getElementById('final_average'+qwe+mas);
                    if (rn.innerHTML ==  common[qwe+'_'+yg]){
                        if (rn.innerHTML == 0){
                            document.getElementById('candidate_row'+qwe+mas).remove();
                        }
                        else{
                            rn.style.backgroundColor = "yellow";
                        }

                    }


                }

            }



        }


    }


</script>

<div id="table">

</div>


<script src="{{asset('js/print.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>
<script src="{{ asset('js/jqueryCdn.js') }}"></script>
{{--<script src="{{ asset('js/score_result.js')}}"></script>--}}
@include('partial.footer')
