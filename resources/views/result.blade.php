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
    </style>
</head>
<body onload="table()">
<div class="d-flex">
    <span style="font-size:30px;cursor:pointer; width: 5%; text-align: center;padding-top: 20px;" onclick="openNav()">&#9776; </span>
    <div class="container-fluid" style="background-color: darkblue; height: 94px;">
        <h2 style="color: white; margin-left: 38%; margin-top: 15px; position: absolute; font-style: italic"></h2>
        <button type="button" class="btn btn-success" onclick="location.href='/admin/home'" style="width: 8%; margin-top: 50px; height: 40px;">Back Home</button>
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
{{--    @livewire('portion-click')--}}
</div>
<button onclick="window.print()">click</button>
<script type="text/javascript">
  let interval =  setInterval(function (){
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
        xhttp.open("GET", "/live-result");
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
        for (let i = 1; i<=count_can; i++){
            if (i == 1){
                scr = "st";
            }
            else if(i==2){
                scr="nd";
            }
            else if (i==3){
                scr = "rd";
            }
            else{
                scr="th";
            }

            for(let t = 1; t<=count_table; t++){
                let rn = rank[i+'_'+t];
                let row_select = document.getElementById('candidate_row'+t+rn);
                let node = document.createElement("td");
                let textnode = document.createTextNode(i+scr);
                node.appendChild(textnode);
                row_select.appendChild(node);
                //row_select.appendChild('<td><b style="color: red;"><i> 1st </i></b></td>');
                if(za == 1){
                   let cge = document.getElementById('final_average'+t+rn);
                   cge.style.backgroundColor = "yellow";
                }
            }
            za++;


        }

    }




  let printBtn = document.querySelector("#print");
  let saveBtn = document.querySelector("#save");

  printBtn.addEventListener("click", function () {
      window.print();
  });

  saveBtn.addEventListener("click", function () {
      html2canvas(document.querySelector("#save_to_image")).then(function (canvas) {
          var link = document.querySelector("#save_to_image");
          link.setAttribute("download", "123456.png");
          link.setAttribute(
              "href",
              canvas.toDataURL("image/png").replace("image/png", "image/octet-stream")
          );
          link.click();
      });
  });

</script>

<div id="table">

</div>


<script src="{{asset('js/print.js')}}"></script>
<script src="{{ asset('js/jqueryCdn.js') }}"></script>
{{--<script src="{{ asset('js/score_result.js')}}"></script>--}}
@include('partial.footer')
