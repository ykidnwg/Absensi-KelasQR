
<?php

use App\Http\Controllers\AuthController;
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

        // Tambahan fitur QR dosen
        Route::get('/absensi-qr', [\App\Http\Controllers\QrAbsensiController::class, 'dosenIndex'])->name('qr.index');
        Route::post('/absensi-qr', [\App\Http\Controllers\QrAbsensiController::class, 'buat'])->name('qr.buat');
        Route::get('/absensi-qr/{sesi}', [\App\Http\Controllers\QrAbsensiController::class, 'tampil'])->name('qr.tampil');
        Route::get('/absensi-qr/{sesi}/token', [\App\Http\Controllers\QrAbsensiController::class, 'token'])->name('qr.token');
        Route::post('/absensi-qr/{sesi}/tutup', [\App\Http\Controllers\QrAbsensiController::class, 'tutup'])->name('qr.tutup');
    });

    // MAHASISWA
    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');

        // Integrasi QR mahasiswa (menggantikan placeholder yang belum berfungsi)
        Route::get('/scan-qr', [\App\Http\Controllers\QrAbsensiController::class, 'mahasiswaIndex'])->name('qr.index');
        Route::post('/scan-qr', [\App\Http\Controllers\QrAbsensiController::class, 'scan'])->name('attendance.scan');

        // Route riwayat absensi mahasiswa bisa ditambahkan nanti.
    });
});
