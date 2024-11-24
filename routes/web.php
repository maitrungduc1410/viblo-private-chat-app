<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\AppController::class, 'index'])->middleware('auth');

Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->middleware('auth');

Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store'])->middleware('auth');

Route::get('/{any}', [App\Http\Controllers\AppController::class, 'index'])->where('any', '.*')->middleware('auth'); // catch all routes or else it will return 404 with Vue router in history mode

