<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UKMController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/ukm', [UKMController::class, 'listUKM'])->name('ukm.index');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Ketua UKM Routes
Route::middleware(['auth', 'role:ketua_ukm'])->group(function () {
    Route::get('/ketua/dashboard', [UKMController::class, 'dashboard'])
        ->name('ketua.dashboard');
    
    Route::get('/ketua/ukm', [UKMController::class, 'index'])
        ->name('ketua.ukm');
    
    Route::get('/ketua/pengajuan', [UKMController::class, 'daftarPengajuan'])
        ->name('ketua.pengajuan');
    
    Route::put('/ketua/pengajuan/{pendaftaran}/update-status', [UKMController::class, 'updateStatus'])
        ->name('ketua.updateStatus');

    // UKM Routes
    Route::post('/ukm', [UKMController::class, 'store'])->name('ukm.store');
    Route::put('/ukm/{ukm}', [UKMController::class, 'update'])->name('ukm.update');
    Route::delete('/ukm/{ukm}', [UKMController::class, 'destroy'])->name('ukm.destroy');

    // Email Routes
    Route::post('/ketua/pengajuan/{pendaftaran}/resend-email', [UKMController::class, 'resendEmail'])
        ->name('ketua.resendEmail');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // Daftar UKM
    Route::get('/mahasiswa/daftar-ukm', [MahasiswaController::class, 'daftarUKM'])
        ->name('mahasiswa.daftarukm');
    
    // Pengajuan UKM
    Route::get('/mahasiswa/pengajuan', [MahasiswaController::class, 'pengajuan'])
        ->name('mahasiswa.pengajuan');
    
    // Ajukan UKM baru
    Route::post('/mahasiswa/ukm/{ukm}/ajukan', [MahasiswaController::class, 'ajukanUKM'])
        ->name('mahasiswa.ajukan');
    
    // Batalkan pengajuan
    Route::delete('/mahasiswa/pengajuan/{pendaftaran}', [MahasiswaController::class, 'batalkanPengajuan'])
        ->name('mahasiswa.batalkan');
});

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
    
Route::post('register', [RegisterController::class, 'register'])
    ->middleware('guest');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';/

