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
        sert();
    },1000);
    function table() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/live-result");
        xhttp.send();
    }
function sert(){
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

    for (let i = 1; i<=count_can; i++){

        for(let t = 1; t<=count_table; t++){
            let rn = rank[i+'_'+t];
            let row_select = document.getElementById('candidate_row'+t+rn);
            let node = document.createElement("td");
            let textnode = document.createTextNode("1st");
            node.appendChild(textnode);
            row_select.appendChild(node);
            //row_select.appendChild('<td><b style="color: red;"><i> 1st </i></b></td>');

        }

        break;
    }

// Create an "li" node:
    let node = document.createElement("li");

// Create a text node:
    const textnode = document.createTextNode("Water");

// Append the text node to the "li" node:
    node.appendChild(textnode);

// Append the "li" node to the list:
    document.getElementById("myList").appendChild(node);

}





</script>

<div id="table">

</div>


<script src="{{ asset('js/jqueryCdn.js') }}"></script>
{{--<script src="{{ asset('js/score_result.js')}}"></script>--}}
@include('partial.footer')
