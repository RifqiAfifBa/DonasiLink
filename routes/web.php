<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonaturController;

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Campaign Feed
Route::get('/CampaignFeed', [KampanyeController::class, 'index'])->name('kampanye.index');
Route::get('/CampaignFeed/{kampanye}', [KampanyeController::class, 'show'])->name('kampanye.show');

// Checkout
Route::get('/Checkout/{kampanye}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/Checkout/{kampanye}', [CheckoutController::class, 'store'])->name('checkout.store');

// Auth
Route::get('/Login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/Login', [AuthController::class, 'login'])->name('login.post');
Route::post('/Logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/Register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/Register', [AuthController::class, 'register'])->name('register.post');

// Shelter
Route::get('/shelter/landingpage', [ShelterController::class, 'landingpage'])->name('shelter.landingpage');
Route::get('/shelter/form', [ShelterController::class, 'formShelter'])->name('shelter.form');
Route::post('/shelter/form', [ShelterController::class, 'storeKampanye'])->name('shelter.storeKampanye');
Route::get('/shelter/withdraw', [ShelterController::class, 'widthdrawShelter'])->name('shelter.withdraw');
Route::get('/shelter/riwayat-penarikan', [ShelterController::class, 'riwayatPenarikan'])->name('shelter.uploadStruk');
Route::get('/shelter/update/{kampanye}', [ShelterController::class, 'updateForm'])->name('shelter.updateForm');
Route::put('/shelter/update/{kampanye}', [ShelterController::class, 'updateKampanye'])->name('shelter.updateKampanye');
Route::post('/shelter/ajukan-penarikan', [ShelterController::class, 'storePenarikan'])->name('shelter.storePenarikan');

// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/shelters',  [AdminController::class, 'shelters'])->name('admin.shelters');
Route::get('/admin/kampanye',  [AdminController::class, 'kampanye'])->name('admin.kampanye');
Route::get('/admin/donasi',    [AdminController::class, 'donasi'])->name('admin.donasi');
Route::get('/admin/penarikan', [AdminController::class, 'penarikan'])->name('admin.penarikan');
Route::post('/admin/penarikan/{penarikan}/accept', [AdminController::class, 'acceptPenarikan'])->name('admin.penarikan.accept');
Route::post('/admin/penarikan/{penarikan}/reject', [AdminController::class, 'rejectPenarikan'])->name('admin.penarikan.reject');

// Donatur
Route::get('/donatur/dashboard', [DonaturController::class, 'dashboard'])->name('donatur.dashboard');

// Impact Story
Route::view('/ImpactStory', 'impact-story')->name('impact-story');
