<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::post('/scan-qr', [AttendanceController::class, 'store'])->name('attendance.scan');