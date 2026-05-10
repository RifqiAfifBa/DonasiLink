<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});
Route::view('/CampaignFeed', 'campaignFeed');
Route::view('/CampaignFeed-Detail', 'campaignFeed-Detail');
Route::view('/Checkout', 'checkout');
Route::view('/ImpactStory', 'impact-story');
Route::view('/Login', 'login');
Route::view('/formShelter', 'shelter.formShelter');
Route::view('/widthdrawShelter', 'shelter.widthdrawShelter');
Route::view('/UploadStruckShelter', 'shelter.UploadStruckShelter');
Route::view('/landingpage', 'shelter.landingpage');
