<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::post('/', [UserController::class, 'store'])->name('user.store');
Route::get('req/', [UserController::class, 'ticket'])->name('user.ticket');
