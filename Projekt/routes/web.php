<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::controller(AnnouncementController::class)->group(function () {
    //Route::get('/trips/image-upload', 'imageUpload')->name('trips.image_upload');
    //Route::post('/trips/image-upload', 'imageUploadStore')->name('trips.image_upload.store');
    Route::get('/home', 'index')->name('cars.index');
    Route::get('/car/{id}', 'show')->name('cars.show');
    //Route::get('/trips/{id}/edit', 'edit')->name('trips.edit');
    //Route::put('/trips/{id}', 'update')->name('trips.update');
    //Route::post('/trips/favourite', 'favourite')->name('trips.favourite');
});



