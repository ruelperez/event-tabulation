<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::post('/reg-judges', [UserController::class, 'store']);
Route::post('/reg-candidate-{candidate}', [\App\Http\Controllers\CandidateController::class, 'store']);

Route::get('/candidate-reg', function () {
    return view('candidate_reg');
});

Route::post('/criteria', [\App\Http\Controllers\CriteriaController::class, 'store']);




