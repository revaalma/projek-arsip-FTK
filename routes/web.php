<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Orang yang buka web langsung dilempar ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua halaman di dalam sini WAJIB LOGIN (dilindungi middleware 'auth')
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Menu Beranda (Dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 2. Menu Arsip (Dinamis berdasarkan slug kategori)
    Route::get('/arsip/{kategori}', [ArchiveController::class, 'index'])->name('arsip.index');

    // 3. Menu Laporan & Pengaturan (Kita siapkan rutenya dulu)
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan');

    // Rute bawaan Breeze untuk ganti password/profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk mengunduh/melihat file secara aman
    Route::get('/arsip/download/{id}', [ArchiveController::class, 'download'])->name('arsip.download');

    // Rute tambah HARUS di atas rute index
    Route::get('/arsip/{kategori}/tambah', [ArchiveController::class, 'create'])->name('arsip.create');
    Route::post('/arsip/{kategori}/simpan', [ArchiveController::class, 'store'])->name('arsip.store');

    Route::get('/arsip/{kategori}', [ArchiveController::class, 'index'])->name('arsip.index');

    //hapus arsip
    Route::delete('/arsip/hapus/{id}', [ArchiveController::class, 'destroy'])->name('arsip.destroy');
});

require __DIR__.'/auth.php';