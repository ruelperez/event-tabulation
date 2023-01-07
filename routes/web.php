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

//Route::get('/x', function () {
//    $event = \App\Models\Event::find(1)->judge;
//    dd($event);
//});

//Route::get('/home', function () {
//    return view('home');
//})->middleware('auth');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'home'])->middleware('auth');;

Route::get('/scoring-page', function () {
    return view('scoring');
});

Route::get('/admin/register', function () {
    return view('user.admin.register');
});

Route::get('/admin/login', function () {
    return view('user.admin.login');
})->name('login')->middleware('guest');

Route::post('/admin/logout', [UserController::class, 'logout']);
Route::post('/admin/login-process', [UserController::class, 'login']);
Route::post('/admin/store', [UserController::class, 'store']);
Route::post('/reg-portion', [\App\Http\Controllers\PortionController::class, 'store']);
Route::post('/reg-title', [\App\Http\Controllers\TitleController::class, 'store']);
Route::post('/reg-judges', [\App\Http\Controllers\JudgeController::class, 'store']);
Route::post('/reg-candidate-{candidate}', [\App\Http\Controllers\CandidateController::class, 'store']);
Route::post('/criteria', [\App\Http\Controllers\CriteriaController::class, 'store']);

//Route::get('/n', function (){
//    return view('nono');
//});



