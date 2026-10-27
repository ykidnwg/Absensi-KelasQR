<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::put('/profil', [AuthController::class, 'updateProfile'])->name('profil.update');
    Route::put('/kata-sandi', [AuthController::class, 'updatePassword'])->name('password.update');

    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.' . auth()->user()->role);
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::resource('dosen', DosenController::class)->except('show');
        Route::resource('mahasiswa', MahasiswaController::class)->except('show');
        Route::resource('kelas', KelasController::class)->except('show');

        // Oben: tambahkan route rekap admin di grup ini saat fitur rekap siap.
    });

    Route::prefix('dosen')->name('dosen.')->middleware('role:dosen')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dosen'])->name('dashboard');

        // Dimas: tambahkan route sesi QR dan pemindaian di grup dosen ini.
        // Oben: tambahkan route rekap kelas di grup dosen ini.
    });

    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');

        // Dimas: tambahkan route pemindaian QR di grup mahasiswa ini.
        // Endpoint lama dipertahankan untuk handler scan yang dikerjakan Dimas.
        Route::post('/scan-qr', [AttendanceController::class, 'store'])->name('attendance.scan');
        // Oben: tambahkan route riwayat absensi di grup mahasiswa ini.
    });
});
