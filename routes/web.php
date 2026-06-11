<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShelterController;

// Public Routes
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/kampanye', [KampanyeController::class, 'index'])->name('kampanye.index');
Route::get('/kampanye/{kampanye}', [KampanyeController::class, 'show'])->name('kampanye.show');

Route::get('/kampanye/{kampanye}/donasi', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/kampanye/{kampanye}/donasi', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/impact-story', function () {
    return view('impact-story');
})->name('impact-story');

Route::get('/foto/{path}', [FotoController::class, 'show'])->where('path', '.*')->name('foto.show');

// Donatur Routes
Route::prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/dashboard', [DonaturController::class, 'dashboard'])->name('dashboard');
});

// Shelter Routes
Route::prefix('shelter')->name('shelter.')->group(function () {
    Route::get('/', [ShelterController::class, 'landingpage'])->name('landingpage');
    Route::get('/kampanye/create', [ShelterController::class, 'formShelter'])->name('form');
    Route::post('/kampanye', [ShelterController::class, 'storeKampanye'])->name('storeKampanye');
    Route::get('/kampanye/{kampanye}/edit', [ShelterController::class, 'updateForm'])->name('updateForm');
    Route::put('/kampanye/{kampanye}', [ShelterController::class, 'updateKampanye'])->name('updateKampanye');
    Route::get('/withdraw', [ShelterController::class, 'withdrawShelter'])->name('withdraw');
    Route::post('/withdraw', [ShelterController::class, 'storePenarikan'])->name('storePenarikan');
    Route::get('/riwayat', [ShelterController::class, 'riwayatPenarikan'])->name('uploadStruk');
    Route::get('/penarikan/{penarikan}/bukti', [ShelterController::class, 'uploadBuktiForm'])->name('bukti.form');
    Route::post('/penarikan/{penarikan}/bukti', [ShelterController::class, 'storeBukti'])->name('bukti.store');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/shelters', [AdminController::class, 'shelters'])->name('shelters');
    Route::get('/kampanye', [AdminController::class, 'kampanye'])->name('kampanye');
    Route::get('/donasi', [AdminController::class, 'donasi'])->name('donasi');
    Route::get('/penarikan', [AdminController::class, 'penarikan'])->name('penarikan');
    Route::post('/penarikan/{penarikan}/accept', [AdminController::class, 'acceptPenarikan'])->name('penarikan.accept');
    Route::post('/penarikan/{penarikan}/reject', [AdminController::class, 'rejectPenarikan'])->name('penarikan.reject');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::post('/users/{type}/{id}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promote');
    Route::delete('/users/{type}/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});

// Notification Routes (JSON API)
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
