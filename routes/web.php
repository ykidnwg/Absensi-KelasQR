
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RekapAbsensiController;
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
        return redirect()->route(auth()->user()->role . '.dashboard');
    })->name('dashboard');

    // ADMIN
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::view('/pengaturan', 'admin.pengaturan.index')->name('pengaturan');

        Route::resource('dosen', DosenController::class)->except('show');
        Route::resource('mahasiswa', MahasiswaController::class)->except('show');
        Route::resource('kelas', KelasController::class)
            ->parameters(['kelas' => 'kelas'])
            ->except('show');

        // REKAP ABSENSI ADMIN
        Route::get('/rekap-absensi', [RekapAbsensiController::class, 'index'])
            ->name('rekap-absensi');
    });

    // DOSEN
    Route::prefix('dosen')->name('dosen.')->middleware('role:dosen')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dosen'])->name('dashboard');

        // Route sesi QR dan rekap kelas dosen bisa ditambahkan nanti.
    });

    // MAHASISWA
    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');

        // Route pemindaian QR
        Route::post('/scan-qr', [AttendanceController::class, 'store'])->name('attendance.scan');

        // Route riwayat absensi mahasiswa bisa ditambahkan nanti.
    });
});