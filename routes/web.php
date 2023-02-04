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
//['auth','isAdmin']
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::get('/home', function (){
        return view('home');
    });
    Route::get('/result', function (){
        return view('result');
    });
});

Route::prefix('judge')->middleware(['isJudge'])->group(function (){
    Route::get('/scoring-page', function () {

        return view('scoring');
    });
});

Route::get('/admin/register', function () {
    return view('user.admin.register');
});


Route::get('/judge/login', function () {
    return view('user.judge.login');
})->middleware('judgeGuest');

Route::get('/admin/login', function () {
    return view('user.admin.login');
})->name('login')->middleware('guest');


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
Route::get('/live-result', [\App\Http\Controllers\Score_resultController::class, 'getData']);
//Route::get('/live-result', [\App\Http\Controllers\Score_resultController::class, 'getData']);

//Route::get('/tes', function () {
//    $test = \App\Models\Criteria::find(16)->portion;
//    dd($test);
//});

