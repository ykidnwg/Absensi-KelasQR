<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data Mata Pelajaran
        $course = Course::firstOrCreate(
            ['code' => 'MTK01'],
            ['name' => 'Matematika', 'teacher_name' => 'Pak Budi']
        );

        // Daftar Siswa Banyak
        $students = [
            ['nisn' => '1001', 'name' => 'Ahmad', 'class' => '10-A', 'qr_code' => 'STUDENT-1001'],
            ['nisn' => '1002', 'name' => 'Budi Santoso', 'class' => '10-A', 'qr_code' => 'STUDENT-1002'],
            ['nisn' => '1003', 'name' => 'Siti Aminah', 'class' => '10-A', 'qr_code' => 'STUDENT-1003'],
            ['nisn' => '1004', 'name' => 'Deni Pratama', 'class' => '10-B', 'qr_code' => 'STUDENT-1004'],
            ['nisn' => '1005', 'name' => 'Eka Putri', 'class' => '10-B', 'qr_code' => 'STUDENT-1005'],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(['nisn' => $student['nisn']], $student);
        }
    }
}