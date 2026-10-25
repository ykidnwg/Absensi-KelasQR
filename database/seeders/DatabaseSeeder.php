<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data Matakuliah
        Course::updateOrCreate(
            ['code' => 'MK-PEMROGRAMAN-01'],
            [
                'name' => 'Pemrograman Web Lanjut',
                'teacher_name' => 'Dr. Hendra, M.Kom'
            ]
        );

        // Data 10 Mahasiswa
        $mahasiswa = [
            ['nim' => '2301001', 'name' => 'Ahmad Fauzi', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301001'],
            ['nim' => '2301002', 'name' => 'Alifia Sandrati', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301002'],
            ['nim' => '2301003', 'name' => 'Budi Pratama', 'class' => 'TI-3B', 'qr_code' => 'MHS-2301003'],
            ['nim' => '2301004', 'name' => 'Citra Lestari', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301004'],
            ['nim' => '2301005', 'name' => 'Dwi Cahyo', 'class' => 'TI-3B', 'qr_code' => 'MHS-2301005'],
            ['nim' => '2301006', 'name' => 'Eka Rahmawati', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301006'],
            ['nim' => '2301007', 'name' => 'Fajar Nugraha', 'class' => 'TI-3B', 'qr_code' => 'MHS-2301007'],
            ['nim' => '2301008', 'name' => 'Gita Gutawa', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301008'],
            ['nim' => '2301009', 'name' => 'Hadi Sucipto', 'class' => 'TI-3B', 'qr_code' => 'MHS-2301009'],
            ['nim' => '2301010', 'name' => 'Indah Permata', 'class' => 'TI-3A', 'qr_code' => 'MHS-2301010'],
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