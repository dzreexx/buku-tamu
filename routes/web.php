<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\DeviceController;
use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/daftar', [UserController::class, 'index'])->name('user.index')->middleware('isGuest');
Route::post('/daftar', [UserController::class, 'store'])->name('user.store');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('isGuest');
Route::post('/login', [UserController::class, 'authentication'])->name('user.auth');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/', [UserController::class, 'main'])->name('beranda');
Route::get('/tentang', [UserController::class, 'about'])->name('tentang');
Route::get('/informasi', [UserController::class, 'info'])->name('informasi');
Route::get('/kunjungan', [UserController::class, 'kunjungan'])->name('kunjungan')->middleware('isVerif');
Route::get('/berita/{id}', [UserController::class, 'berita'])->name('berita');
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
    ])->name('edit-profile-store')->middleware('isLogin');
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
    Route::get('/admin/new-users', [
        AdminController::class, 'getNewUsers'
        ])->name('new.users');

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
    Route::get('/berita/search', [
        AdminController::class, 'newsSearch'
    ])->name('news.search')->middleware('isAdmin');
    Route::get('/berita/buat', [
        AdminController::class, 'newsCreate'
    ])->middleware('isAdmin');
    // Route::get('/berita/buat', [
    //     AdminController::class, 'newsCreate'
    // ])->name('news.create')->middleware('isAdmin');
    Route::post('/berita/buat', [
        AdminController::class, 'storeNews'
        ])->name('news.store')->middleware('isAdmin');
    Route::get('/berita/{id}', [
        AdminController::class, 'newsDetail'
    ])->name('news.detail')->middleware('isAdmin');
    Route::get('/berita/{id}/edit', [
        AdminController::class, 'newsUpdate'
    ])->name('news.update')->middleware('isAdmin');
    Route::post('/berita/{id}/edit', [
        AdminController::class, 'newsUpdateStore'
    ])->middleware('isAdmin');
    Route::delete('/berita/{id}/hapus', [
        AdminController::class, 'newsDestroy'
    ])->middleware('isAdmin');

    // Route::get('/test', [
    //     AdminController::class, 'test'
    // ])->name('test')->middleware('isAdmin');
    
    Route::get('/informasi', [
        AdminController::class, 'info'
    ])->name('info')->middleware('isAdmin');
    Route::get('/informasi/search', [
        AdminController::class, 'infoSearch'
    ])->name('info.search')->middleware('isAdmin');
    Route::get('/informasi/{id}/ubah', [
        AdminController::class, 'infoUpdate'
    ])->name('info.update')->middleware('isAdmin');
    Route::put('/informasi/{id}/ubah', [
        AdminController::class, 'infoStoreUpdate'
    ])->name('info.store.update')->middleware('isAdmin');
    // Route::get('/informasi/{id}', [
    //     AdminController::class, 'infoDetail'
    // ])->name('info.detail')->middleware('isAdmin');
    Route::get('/informasi/buat', [
        AdminController::class, 'infoCreate'
    ])->name('info.create')->middleware('isAdmin');
    Route::post('/informasi/buat', [
        AdminController::class, 'infoStore'
    ])->name('info.store')->middleware('isAdmin');
    Route::delete('/informasi/{id}/hapus', [
        AdminController::class, 'infoDestroy'
    ])->name('info.destroy')->middleware('isAdmin');
    });
Route::get('/kunjungan-langsung', [GuestController::class, 'index'])->name('guest.index')->middleware('isGuest');
Route::post('/kunjungan-langsung', [GuestController::class, 'store'])->name('guest.store');
Route::get('req/{id}', [GuestController::class, 'ticket'])->name('guest.ticket');
Route::post('checkout/{id}', [GuestController::class, 'checkOut'])->name('guest.checkout');
Route::get('device-check', [DeviceController::class, 'detectDevice'])->name('device.check');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Reset Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => 'Tautan telah dikirim ke email anda.'])
                : back()->withErrors(['email' => 'Tautan gagal dikirim.']);
})->middleware('guest')->name('password.email');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');