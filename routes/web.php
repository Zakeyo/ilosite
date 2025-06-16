<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Sys\UserController;
use App\Http\Controllers\Sys\SysController;
use App\Http\Controllers\Sys\ApplicantController;
use App\Http\Controllers\Sys\LicenseController;
use App\Http\Controllers\Sys\ReferredController;

// Página de inicio
Route::get('/', WelcomeController::class)->name('welcome');

// Buscador (sin login)
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Sistema (requiere login)
Route::middleware(['auth'])->prefix('sys')->group(function () {
    Route::get('/', [SysController::class, 'index'])->name('sys');

    Route::resource('/applicants', ApplicantController::class)->names('sys.applicants');
    Route::resource('/licenses', LicenseController::class)->names('sys.license');
    Route::resource('/referreds', ReferredController::class)->names('sys.referreds');
    Route::resource('/users', UserController::class)->names('sys.users');
});


require __DIR__.'/auth.php';