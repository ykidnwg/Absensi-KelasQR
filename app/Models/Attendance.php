<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Absensi milik 1 Siswa
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi: Absensi milik 1 Mata Pelajaran
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}