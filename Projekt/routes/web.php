<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/{id}', [UserController::class, 'user'])->name('cars.user');
    Route::controller(PhotoController::class)->group(function () {

    });
});

Route::middleware(['auth'])->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user/edit/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::put('/user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser'); // Dodaj tę trasę
    Route::delete('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/announcement/edit/{id}', [AdminController::class, 'editAnnouncement'])->name('admin.editAnnouncement');
    Route::put('/announcement/update/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.updateAnnouncement'); // Dodaj tę trasę
    Route::delete('/announcement/delete/{id}', [AdminController::class, 'deleteAnnouncement'])->name('admin.deleteAnnouncement');
});


Route::controller(AnnouncementController::class)->group(function () {
        Route::get('/home', 'index')->name('cars.index');
        Route::get('/car/{id}', 'show')->name('cars.show');
        Route::get('/car/{id}/edit', 'edit')->name('cars.edit');
        Route::put('/car/{id}', 'update')->name('announcements.update');
        Route::get('/oferty', 'oferty')->name('cars.oferty');
        Route::delete('/announcement/{id}', 'destroy')->name('cars.destroy');
    });

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'authenticate')->name('login.authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});
