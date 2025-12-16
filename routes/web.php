<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\KatalogController as AdminKatalogController;
use App\Http\Controllers\Admin\MisiController;
use App\Http\Controllers\Admin\AnggotaManagementController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuAnggotaController;

// =====================================================
// ADMIN ROUTES
// =====================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Route yang TIDAK perlu login (guest routes)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // Route yang HARUS login (protected with AdminMiddleware)
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        // Dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Info Admin (BPD only)
        Route::get('info-admin', [AdminDashboardController::class, 'infoAdmin'])->name('info-admin');
        Route::get('create-admin', [AdminDashboardController::class, 'createAdmin'])->name('create-admin');
        Route::post('store-admin', [AdminDashboardController::class, 'storeAdmin'])->name('store-admin');
        Route::get('edit-admin/{admin}', [AdminDashboardController::class, 'editAdmin'])->name('edit-admin');
        Route::put('update-admin/{admin}', [AdminDashboardController::class, 'updateAdmin'])->name('update-admin');
        Route::delete('delete-admin/{admin}', [AdminDashboardController::class, 'deleteAdmin'])->name('delete-admin');

        // Logout
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
        Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');

        // Organisasi CRUD
        Route::resource('organisasi', OrganisasiController::class);

        // E-Katalog CRUD
        Route::resource('katalog', AdminKatalogController::class);

        // Misi CRUD
        Route::resource('misi', MisiController::class);

        // Anggota Management
        Route::prefix('anggota')->name('anggota.')->group(function () {
            // Routes untuk Verifikasi (Menu Dashboard - hanya BPC yang bisa approve/reject)
            Route::get('/', [AnggotaManagementController::class, 'index'])->name('index');
            Route::get('/{anggota}', [AnggotaManagementController::class, 'show'])->name('show');
            Route::post('/{anggota}/approve', [AnggotaManagementController::class, 'approve'])->name('approve');
            Route::post('/{anggota}/reject', [AnggotaManagementController::class, 'reject'])->name('reject');
            Route::delete('/{anggota}', [AnggotaManagementController::class, 'destroy'])->name('destroy');
            
            // Routes baru untuk List Anggota (Read-Only - BPC & BPD bisa akses)
            Route::get('/list/all', [AnggotaManagementController::class, 'listAll'])->name('list');
            Route::get('/list/{anggota}/detail', [AnggotaManagementController::class, 'showReadOnly'])->name('show-readonly');
        });
    });
});

// =====================================================
// PUBLIC ROUTES
// =====================================================

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// E-Katalog Public Routes
Route::get('/e-katalog', [KatalogController::class, 'index'])->name('e-katalog');
Route::get('/e-katalog/{katalog}', [KatalogController::class, 'show'])->name('e-katalog.detail');

// Other Public Pages
Route::view('/organisasi', 'pages.organisasi')->name('organisasi');
Route::view('/berita', 'pages.berita')->name(name: 'berita');
Route::view('/berita/detail', 'pages.details.berita-detail')->name('berita-detail');
Route::view('/umkm', 'pages.registrasi-umkm')->name('umkm');

// Jadi Anggota - Form & Submit
Route::get('/jadi-anggota', function () {
    return view('pages.jadi-anggota');
})->name('jadi-anggota');
Route::post('/jadi-anggota', [AnggotaController::class, 'store'])->name('jadi-anggota.store');
Route::view('/detail-buku', 'pages.details.buku-detail')->name('detail-buku');
Route::view('/informasi-kegiatan', 'pages.informasi-kegiatan')->name('informasi-kegiatan');
Route::view('/detail-kegiatan', 'pages.details.kegiatan-detail')->name('detail-kegiatan');
Route::get('/buku-informasi-anggota', [BukuAnggotaController::class, 'index'])->name('buku-anggota');
Route::get('/buku-informasi-anggota/{anggota}', [BukuAnggotaController::class, 'show'])->name('detail-buku');