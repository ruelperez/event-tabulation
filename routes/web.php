<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\AdminHome;
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
    return view('user.admin.login',['title'=>'Admin log in']);
})->name('login')->middleware('guest');


//['auth','isAdmin']
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::get('/event', function (){
        return view('home',['title'=>'tabulation - event title']);
    });

    Route::get('/registration/{reg}/{id}', function ($reg,$id){
        return view('registration', ['regis' => $reg,'eventNUM'=>$id, 'title' => $reg. ' registration' ]);
    });

   // Route::get('/registration/{id}/{reg}', [AdminHome::class, 'click']);

    Route::get('/result/{eventID}', [\App\Http\Controllers\Score_resultController::class, 'getPortion']);

    Route::get('/result/{por_event}/{por_id}', function ($por_event,$por_id){
        return view('result', ['porID' => $por_id, 'title' => 'Tabulation Result']);
    });

    Route::get('/live-result/{porID}', [\App\Http\Controllers\Score_resultController::class, 'getData']);
});

Route::prefix('judge')->middleware(['isJudge'])->group(function (){
    Route::get('/scoring-page', function () {
        return view('scoring',['title' => 'Tabulation | Input score']);
    });
});

Route::get('/admin/register', function () {
    return view('user.admin.register',['title'=>'Admin sign up']);
});


Route::get('/judge/login', function () {
    return view('user.judge.login',['title' => 'Tabulation | judge log in']);
})->middleware('judgeGuest');


Route::post('/judge/logout', [\App\Http\Controllers\JudgeController::class, 'logout']);
Route::post('/judge/login-process', [\App\Http\Controllers\JudgeController::class, 'process']);
Route::post('/admin/logout', [UserController::class, 'logout']);
Route::post('/admin/login-process', [UserController::class, 'login']);
Route::post('/admin/store', [UserController::class, 'store']);
Route::post('/reg-portion', [\App\Http\Controllers\PortionController::class, 'store']);
Route::post('/reg-title', [\App\Http\Controllers\TitleController::class, 'store']);
Route::post('/reg-judges', [\App\Http\Controllers\JudgeController::class, 'store']);
Route::post('/reg-candidate', [\App\Http\Controllers\CandidateController::class, 'store']);
Route::post('/criteria', [\App\Http\Controllers\CriteriaController::class, 'store']);
Route::post('/rating/store', [\App\Http\Controllers\RatingController::class, 'store']);

//Route::get('/live-result', [\App\Http\Controllers\Score_resultController::class, 'getData']);
