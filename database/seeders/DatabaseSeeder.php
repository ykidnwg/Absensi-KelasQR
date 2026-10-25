<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Data Matakuliah & Dosen
        Course::updateOrCreate(
            ['code' => 'MK-PEMROGRAMAN-01'],
            [
                'name' => 'Pemrograman Web Lanjut',
                'teacher_name' => 'Dr. Hendra, M.Kom'
            ]
        );

        // 2. Data Mahasiswa
        $mahasiswa = [
            ['nim' => '2301001', 'name' => 'Ahmad Fauzi', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301001'],
            ['nim' => '2301002', 'name' => 'Alifia Sandrati', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301002'],
            ['nim' => '2301003', 'name' => 'Budi Pratama', 'class' => 'TI-3B', 'qr_code' => 'MHS-2301003'],
        ];

        foreach ($mahasiswa as $mhs) {
            Student::updateOrCreate(
                ['nim' => $mhs['nim']],
                [
                    'nim' => $mhs['nim'],
                    'name' => $mhs['name'],
                    'class' => $mhs['class'],
                    'qr_code' => $mhs['qr_code'],
                ]
            );
        }
    }
}