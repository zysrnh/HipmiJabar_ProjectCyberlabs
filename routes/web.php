<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\KatalogController as AdminKatalogController;
use App\Http\Controllers\KatalogController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('info-admin', [AdminDashboardController::class, 'infoAdmin'])->name('info-admin');
    Route::get('create-admin', [AdminDashboardController::class, 'createAdmin'])->name('create-admin');
    Route::post('store-admin', [AdminDashboardController::class, 'storeAdmin'])->name('store-admin');
    Route::get('edit-admin/{admin}', [AdminDashboardController::class, 'editAdmin'])->name('edit-admin');
    Route::put('update-admin/{admin}', [AdminDashboardController::class, 'updateAdmin'])->name('update-admin');
    Route::delete('delete-admin/{admin}', [AdminDashboardController::class, 'deleteAdmin'])->name('delete-admin');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');

    Route::resource('organisasi', OrganisasiController::class);
    
    // Admin E-Katalog Routes - pakai 'katalog' untuk admin
    Route::resource('katalog', AdminKatalogController::class);
});

// Public Routes
Route::view('/', 'pages.home')->name('home');

// E-Katalog Public Routes - pakai 'e-katalog' untuk public
Route::get('/e-katalog', [KatalogController::class, 'index'])->name('e-katalog');
Route::get('/e-katalog/{katalog}', [KatalogController::class, 'show'])->name('e-katalog.detail');

Route::view('/organisasi', 'pages.organisasi')->name('organisasi');
Route::view('/berita', 'pages.berita')->name('berita');
Route::view('/umkm', 'pages.umkm')->name('umkm');