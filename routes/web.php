<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DeviceController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/daftar', [UserController::class, 'index'])->name('user.index')->middleware('isGuest');
Route::post('/daftar', [UserController::class, 'store'])->name('user.store');
Route::get('/login', [UserController::class, 'login'])->name('user.login')->middleware('isGuest');
Route::post('/login', [UserController::class, 'authentication'])->name('user.auth');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/main', [UserController::class, 'main'])->name('beranda')->middleware('isLogin');
Route::get('/tentang', [UserController::class, 'about'])->name('tentang')->middleware('isLogin');
Route::get('/informasi', [UserController::class, 'info'])->name('informasi')->middleware('isLogin');
Route::get('/kunjungan', [UserController::class, 'kunjungan'])->name('kunjungan')->middleware('isVerif');
Route::prefix('/user')->group(function () {
    Route::get('/kunjungan', [
        UserController::class, 'userGuest'
    ])->name('user-guest')->middleware('isVerif');
    Route::get('/profile', [
        UserController::class, 'userProfile'
    ])->name('user-profile')->middleware('isVerif');
    Route::get('/profile/edit', [
        UserController::class, 'editProfile'
    ])->name('edit-profile')->middleware('isVerif');
    Route::post('/profile/edit', [
        UserController::class, 'updateProfile'
    ])->name('edit-profile')->middleware('isLogin');
});
Route::prefix('/admin')->group(function () {
    Route::get('/login', [
        AdminController::class, 'index'
    ])->name('admin-login')->middleware('isGuest');
    Route::get('/', [
        AdminController::class, 'main'
    ])->name('admin-main')->middleware('isAdmin');
    Route::get('/tamu', [
        AdminController::class, 'tamu'
    ])->name('admin-tamu')->middleware('isAdmin');
    Route::get('/guests/search', [
        AdminController::class, 'guestSearch'
    ])->name('guest.search')->middleware('isAdmin');
    Route::get('/pengguna', [
        AdminController::class, 'user'
    ])->name('admin-user')->middleware('isAdmin');
    Route::get('/user/search', [
        AdminController::class, 'userSearch'
    ])->name('user.search')->middleware('isAdmin');
    Route::put('/verify/{user}', [
        AdminController::class, 'verify'
    ])->name('users.verify')->middleware('isAdmin');
    Route::delete('/pengguna/{user}', [
        UserController::class, 'destroy'
    ])->name('users.destroy')->middleware('isAdmin');
    Route::get('/berita', [
        AdminController::class, 'news'
    ])->name('news')->middleware('isAdmin');
    Route::get('/berita/buat', [
        AdminController::class, 'newsCreate'
    ])->name('news.create')->middleware('isAdmin');
    Route::post('/berita/buat', [
        AdminController::class, 'storeNews'
        ])->name('news.store')->middleware('isAdmin');
    Route::get('/informasi', [
        AdminController::class, 'info'
    ])->name('info')->middleware('isAdmin');
    Route::get('/informasi/buat', [
        AdminController::class, 'newsCreate'
    ])->name('news.create')->middleware('isAdmin');
    });
Route::get('/', [GuestController::class, 'index'])->name('guest.index')->middleware('isGuest');
Route::post('/', [GuestController::class, 'store'])->name('guest.store');
Route::get('req/{id}', [GuestController::class, 'ticket'])->name('guest.ticket');
Route::post('checkout/{id}', [GuestController::class, 'checkOut'])->name('guest.checkout');
Route::get('device-check', [DeviceController::class, 'detectDevice'])->name('device.check');