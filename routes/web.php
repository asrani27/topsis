<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Login Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Register Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Admin Routes (Group) - Protected by authentication middleware
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // Pegawai Management
    Route::get('/pegawai', [App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pegawai/create', [App\Http\Controllers\PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    // Kriteria Management
    Route::get('/kriteria', [App\Http\Controllers\KriteriaController::class, 'index'])->name('kriteria');
    Route::get('/kriteria/create', [App\Http\Controllers\KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria', [App\Http\Controllers\KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{kriteria}', [App\Http\Controllers\KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{kriteria}', [App\Http\Controllers\KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{kriteria}', [App\Http\Controllers\KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    // Penilaian
    Route::get('/penilaian', [App\Http\Controllers\PenilaianController::class, 'index'])->name('penilaian');
    Route::get('/penilaian/{pegawai}', [App\Http\Controllers\PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{pegawai}', [App\Http\Controllers\PenilaianController::class, 'update'])->name('penilaian.update');

    // Normalisasi
    Route::get('/normalisasi', function () {
        return 'Halaman Normalisasi - Akan diimplementasikan dengan controller';
    })->name('normalisasi');

    // Nilai TOPSIS
    Route::get('/nilai-topsis', [App\Http\Controllers\TopsisController::class, 'index'])->name('nilai-topsis');

    // Laporan
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/kriteria/pdf', [App\Http\Controllers\LaporanController::class, 'kriteriaPdf'])->name('laporan.kriteria.pdf');
    Route::get('/laporan/pegawai/pdf', [App\Http\Controllers\LaporanController::class, 'pegawaiPdf'])->name('laporan.pegawai.pdf');
    Route::get('/laporan/ranking/pdf', [App\Http\Controllers\LaporanController::class, 'rankingPdf'])->name('laporan.ranking.pdf');
});
