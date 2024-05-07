<?php

use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('countries', CountryController::class);

Route::prefix('trips')->name('trips.')->controller(TripController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{trip}', 'show')->name('show');
    Route::get('/{trip}/edit', 'edit')->name('edit');
    Route::put('/{trip}', 'update')->name('update');
});
