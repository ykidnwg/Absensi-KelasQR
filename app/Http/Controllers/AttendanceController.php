<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Course;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'qr_code' => 'required',
        ]);

        // Cari siswa berdasarkan QR Code
        $student = Student::where('qr_code', $request->qr_code)->first();

        if (!$student) {
            return back()->with('error', 'Siswa tidak ditemukan!');
        }

        // Ambil data course pertama (atau sesuaikan ID matkul aktif)
        $course = Course::first();

        if (!$course) {
            return back()->with('error', 'Belum ada data Mata Pelajaran di database!');
        }

        // Simpan data absensi
        Attendance::create([
            'student_id' => $student->id,
            'course_id'  => $course->id,
            'scanned_at' => now(),
            'status'     => 'hadir',
        ]);

        return back()->with('success', 'Absensi berhasil untuk: ' . $student->name);
    }
}