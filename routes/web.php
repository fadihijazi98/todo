<?php

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

Route::resource('board', \App\Http\Controllers\BoardController::class);
Route::post('/board/search', [\App\Http\Controllers\BoardController::class, 'search']);

Route::resource('task', \App\Http\Controllers\TaskController::class);
Route::put('/task/{task}/completed', [\App\Http\Controllers\TaskController::class, 'markTaskAsCompleted']);
Route::put('/task/{task}/pending', [\App\Http\Controllers\TaskController::class, 'markTaskAsPending']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
