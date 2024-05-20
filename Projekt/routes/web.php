<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user/{id}', 'user')->name('cars.user');
});


Route::controller(AnnouncementController::class)->group(function () {
    //Route::get('/trips/image-upload', 'imageUpload')->name('trips.image_upload');
    //Route::post('/trips/image-upload', 'imageUploadStore')->name('trips.image_upload.store');
    Route::get('/home', 'index')->name('cars.index');
    Route::get('/car/{id}', 'show')->name('cars.show');
    //Route::get('/trips/{id}/edit', 'edit')->name('trips.edit');
    Route::get('/oferty', 'oferty')->name('cars.oferty');
    //Route::post('/trips/favourite', 'favourite')->name('trips.favourite');
});

Route::controller(PhotoController::class)->group(function () {
   // Route::get('/car/{id}', 'show')->name('cars.show');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'authenticate')->name('login.authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});

