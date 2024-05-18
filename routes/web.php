<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::post('/', [UserController::class, 'store'])->name('user.store');
Route::get('req/{id}', [UserController::class, 'ticket'])->name('user.ticket');
Route::post('checkout/{id}', [UserController::class, 'checkOut'])->name('user.checkout');
Route::get('device-check', [DeviceController::class, 'detectDevice'])->name('device.check');