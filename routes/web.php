<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\KatalogController as AdminKatalogController;
use App\Http\Controllers\Admin\MisiController;
use App\Http\Controllers\Admin\AnggotaManagementController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\UmkmManagementController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaAuthController;
use App\Http\Controllers\BukuAnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UmkmController;

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

        // Organisasi CRUD (BPD only)
        Route::resource('organisasi', OrganisasiController::class);

        // E-Katalog CRUD (BPD only)
        Route::resource('katalog', AdminKatalogController::class);

        // Misi CRUD (BPD only)
        Route::resource('misi', MisiController::class);

        // Berita CRUD (BPD only)
        Route::get('berita', [AdminBeritaController::class, 'index'])->name('berita.index');
        Route::get('berita/create', [AdminBeritaController::class, 'create'])->name('berita.create');
        Route::post('berita', [AdminBeritaController::class, 'store'])->name('berita.store');
        Route::get('berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
        Route::put('berita/{id}', [AdminBeritaController::class, 'update'])->name('berita.update');
        Route::delete('berita/{id}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');

        // Anggota Management
        Route::prefix('anggota')->name('anggota.')->group(function () {
            Route::get('/', [AnggotaManagementController::class, 'index'])->name('index');
            Route::get('/{anggota}', [AnggotaManagementController::class, 'show'])->name('show');
            Route::post('/{anggota}/approve', [AnggotaManagementController::class, 'approve'])->name('approve');
            Route::post('/{anggota}/reject', [AnggotaManagementController::class, 'reject'])->name('reject');
            Route::delete('/{anggota}', [AnggotaManagementController::class, 'destroy'])->name('anggota.destroy');
            Route::get('/list/all', [AnggotaManagementController::class, 'listAll'])->name('list');
            Route::get('/list/{anggota}/detail', [AnggotaManagementController::class, 'showReadOnly'])->name('show-readonly');
        });

        // UMKM Management
        Route::prefix('umkm-management')->name('umkm.')->group(function () {
            Route::get('/', [UmkmManagementController::class, 'index'])->name('index');
            Route::get('/export', [UmkmManagementController::class, 'export'])->name('export');
            Route::get('/{umkm}', [UmkmManagementController::class, 'show'])->name('show');
            Route::post('/{umkm}/approve', [UmkmManagementController::class, 'approve'])->name('approve');
            Route::post('/{umkm}/reject', [UmkmManagementController::class, 'reject'])->name('reject');
            Route::delete('/{umkm}', [UmkmManagementController::class, 'destroy'])->name('destroy');
        });
    });
});

// =====================================================
// ANGGOTA AUTH ROUTES
// =====================================================
Route::prefix('anggota')->name('anggota.')->group(function () {
    // Login routes (guest only)
    Route::middleware('guest:anggota')->group(function () {
        Route::get('login', [AnggotaAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AnggotaAuthController::class, 'login'])->name('login.post');
    });

    // Protected routes (must be logged in)
    Route::middleware('auth:anggota')->group(function () {
        Route::post('logout', [AnggotaAuthController::class, 'logout'])->name('logout');
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

// Berita Public Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita-detail');

// Other Public Pages
Route::view('/organisasi', 'pages.organisasi')->name('organisasi');

// ✨ UMKM Registration - PROTECTED (Harus Login) ✨

    Route::get('/umkm', [UmkmController::class, 'create'])->name('umkm');
    Route::post('/umkm', [UmkmController::class, 'store'])->name('umkm.store');


// Jadi Anggota (Public - Registration)
Route::get('/jadi-anggota', function () {
    // Redirect jika sudah login
    if (Auth::guard('anggota')->check()) {
        return redirect()->route('profile-anggota');
    }
    return view('pages.jadi-anggota');
})->name('jadi-anggota');
Route::post('/jadi-anggota', [AnggotaController::class, 'store'])->name('jadi-anggota.store');

// Registration Success Page (Protected)
Route::get('/registration-success', function () {
    if (!session()->has('generated_password')) {
        return redirect()->route('home');
    }
    return view('pages.registration-success');
})->middleware('auth:anggota')->name('registration-success');

// Profile Anggota Routes (Protected)
Route::middleware('auth:anggota')->group(function () {
    Route::get('/profile-anggota', [AnggotaController::class, 'profile'])->name('profile-anggota');
    Route::post('/profile-anggota/change-password', [AnggotaController::class, 'changePassword'])->name('profile-anggota.change-password');
    
    // CRUD Profile Routes
    Route::post('/profile-anggota/update-profile', [AnggotaController::class, 'updateProfile'])->name('profile-anggota.update-profile');
    Route::post('/profile-anggota/update-company', [AnggotaController::class, 'updateCompany'])->name('profile-anggota.update-company');
    Route::post('/profile-anggota/upload-detail-images', [AnggotaController::class, 'uploadDetailImages'])->name('profile-anggota.upload-detail-images');
    Route::post('/profile-anggota/delete-detail-image', [AnggotaController::class, 'deleteDetailImage'])->name('profile-anggota.delete-detail-image');
});

// Other Routes
Route::view('/informasi-kegiatan', 'pages.informasi-kegiatan')->name('informasi-kegiatan');
Route::view('/detail-kegiatan', 'pages.details.kegiatan-detail')->name('detail-kegiatan');

// Buku Anggota Routes
Route::get('/buku-informasi-anggota', [BukuAnggotaController::class, 'index'])->name('buku-anggota');
Route::get('/buku-informasi-anggota/{anggota}', [BukuAnggotaController::class, 'show'])->name('detail-buku');