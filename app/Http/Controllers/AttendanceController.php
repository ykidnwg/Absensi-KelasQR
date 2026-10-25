<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Ambil data mata kuliah dan 10 data mahasiswa dari database
        $course = Course::first();
        $students = Student::all();

        // Tampilkan ke view Blade UI
        return view('dashboard', compact('course', 'students'));
    }
}