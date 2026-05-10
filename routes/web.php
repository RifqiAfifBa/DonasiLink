<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AuthController;

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

// Shelter
Route::get('/shelter/landingpage', [ShelterController::class, 'landingpage'])->name('shelter.landingpage');
Route::get('/shelter/form', [ShelterController::class, 'formShelter'])->name('shelter.form');
Route::post('/shelter/form', [ShelterController::class, 'storeKampanye'])->name('shelter.storeKampanye');
Route::get('/shelter/withdraw', [ShelterController::class, 'widthdrawShelter'])->name('shelter.withdraw');
Route::get('/shelter/upload-struk', [ShelterController::class, 'uploadStruk'])->name('shelter.uploadStruk');
Route::get('/shelter/update/{kampanye}', [ShelterController::class, 'updateForm'])->name('shelter.updateForm');
Route::put('/shelter/update/{kampanye}', [ShelterController::class, 'updateKampanye'])->name('shelter.updateKampanye');
Route::post('/shelter/upload-struk', [ShelterController::class, 'storeStruk'])->name('shelter.storeStruk');

// Impact Story
Route::view('/ImpactStory', 'impact-story')->name('impact-story');
