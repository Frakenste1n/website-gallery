<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminInformasiController;
use App\Http\Controllers\Admin\AdminAgendaController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\WebSettingController;

// Route untuk halaman utama (welcome) hanya bisa diakses oleh guest
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

// Route untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Home sebagai landing page setelah login untuk user biasa
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Gallery Routes
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/{id}', [GalleryController::class, 'show'])->name('show');
        
        // Route untuk like dan komentar
        Route::post('/photo/{id}/like', [GalleryController::class, 'likePhoto'])->name('photo.like');
        Route::post('/photo/{id}/comment', [GalleryController::class, 'addComment'])->name('comment.add');
        Route::delete('/comment/{id}', [GalleryController::class, 'deleteComment'])->name('comment.delete');
        Route::get('/photo/{id}', [GalleryController::class, 'showPhotoDetail'])->name('photo.detail');
    });

    // Informasi Routes
    Route::prefix('informasi')->name('informasi.')->group(function () {
        Route::get('/', [InformasiController::class, 'index'])->name('index');
        Route::get('/show/{id}', [InformasiController::class, 'show'])->name('show');
        Route::get('/kategori/{kategori}', [InformasiController::class, 'getByKategori'])->name('kategori');
        Route::get('/search', [InformasiController::class, 'search'])->name('search');
        Route::get('/latest', [InformasiController::class, 'getLatestInformasi'])->name('latest');
    });

    // Agenda Routes
    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::get('/{agenda}', [AgendaController::class, 'show'])->name('show');
        Route::get('/upcoming', [AgendaController::class, 'getUpcoming'])->name('upcoming');
        Route::get('/search', [AgendaController::class, 'search'])->name('search');
        Route::get('/date/{date}', [AgendaController::class, 'getByDate'])->name('byDate');
        Route::get('/latest', [AgendaController::class, 'getLatest'])->name('latest');
    });
});

 // Route untuk admin
 Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    // Gallery Management
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [AdminGalleryController::class, 'index'])->name('index');
        Route::get('/create', [AdminGalleryController::class, 'create'])->name('create');
        Route::post('/', [AdminGalleryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminGalleryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminGalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminGalleryController::class, 'destroy'])->name('destroy');
        
        // Route untuk mengelola foto dalam album
        Route::get('/{albumId}/photos', [AdminGalleryController::class, 'showPhotos'])->name('photo');
        Route::post('/{albumId}/photos', [AdminGalleryController::class, 'createPhoto'])->name('photo.store');
        Route::put('/photos/{id}', [AdminGalleryController::class, 'updatePhoto'])->name('photo.update');
        Route::delete('/photos/{id}', [AdminGalleryController::class, 'destroyPhoto'])->name('photo.destroy');
        Route::get('/photos/{id}/details', [AdminGalleryController::class, 'getPhotoDetails'])->name('photo.details');
        Route::get('/photos/{id}/detail', [AdminGalleryController::class, 'showPhotoDetail'])->name('photo.detail');
        Route::post('/photos/{id}/comment', [AdminGalleryController::class, 'storeComment'])->name('photo.comment.store');
        Route::delete('/comments/{id}', [AdminGalleryController::class, 'destroyComment'])->name('photo.comment.destroy');
    });

    // Informasi Management
    Route::prefix('informasi')->name('informasi.')->group(function () {
        Route::get('/', [AdminInformasiController::class, 'index'])->name('index');
        Route::get('/create', [AdminInformasiController::class, 'create'])->name('create');
        Route::post('/', [AdminInformasiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminInformasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminInformasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminInformasiController::class, 'destroy'])->name('destroy');
        Route::post('/toggle-status/{id}', [AdminInformasiController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/search', [AdminInformasiController::class, 'search'])->name('search');
        Route::get('/kategori/{kategori}', [AdminInformasiController::class, 'getByKategori'])->name('kategori');
    });

    // Agenda Management
    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AdminAgendaController::class, 'index'])->name('index');
        Route::get('/create', [AdminAgendaController::class, 'create'])->name('create');
        Route::post('/store', [AdminAgendaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminAgendaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminAgendaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminAgendaController::class, 'destroy'])->name('destroy');
    });

    // Settings routes
    Route::get('/settings', [WebSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [WebSettingController::class, 'update'])->name('settings.update');
});

