<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
// =============================================
// AUTH ROUTES (Public)
// =============================================
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('siswa.index');
    }
    return redirect()->route('login');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori', KategoriController::class)->except(['show']);
});

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =============================================
// SISWA ROUTES (Protected)
// =============================================
Route::middleware('auth')->group(function () {
    // Beranda Siswa
    Route::get('/siswa', [AspirasiController::class, 'index'])->name('siswa.index');
    
    // Form & Submit Aspirasi
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    
    // Histori & Detail Aspirasi
    Route::get('/aspirasi/histori', [AspirasiController::class, 'histori'])->name('aspirasi.histori');
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
});

// =============================================
// ADMIN ROUTES (Protected & Admin Only)
// =============================================
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // List & Filter Aspirasi
    Route::get('/aspirasi', [AdminController::class, 'listAspirasi'])->name('admin.list');
    Route::get('/aspirasi/{id}', [AdminController::class, 'detailAspirasi'])->name('admin.detail');
    
    // Feedback
    Route::get('/aspirasi/{id}/feedback', [AdminController::class, 'showFeedbackForm'])->name('admin.feedback.form');
    Route::post('/aspirasi/{id}/feedback', [AdminController::class, 'saveFeedback'])->name('admin.feedback.save');
    
    // Export (Optional)
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    
});

