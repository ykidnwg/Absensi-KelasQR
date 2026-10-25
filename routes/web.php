<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('scan');
});

Route::post('/scan', [AttendanceController::class, 'store'])->name('scan.store');