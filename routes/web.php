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
    if (\Illuminate\Support\Facades\Auth::user())
        return redirect('/home');

    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('board', \App\Http\Controllers\BoardController::class);
    Route::post('/board/search', [\App\Http\Controllers\BoardController::class, 'search']);

    Route::resource('task', \App\Http\Controllers\TaskController::class);
    Route::put('/task/{task}/completed', [\App\Http\Controllers\TaskController::class, 'markTaskAsCompleted']);
    Route::put('/task/{task}/pending', [\App\Http\Controllers\TaskController::class, 'markTaskAsPending']);
    Route::post('/task/search', [\App\Http\Controllers\TaskController::class, 'search']);

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();

Route::get('/board/share/{id}', [\App\Http\Controllers\BoardController::class, 'renderShareBoard']);

