<?php

use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TripController::class)->group(function () {
    Route::get('/trips', 'index');
    Route::get('/trips/{id}', 'show')->name('trips.show');
});

