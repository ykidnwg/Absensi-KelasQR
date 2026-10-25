<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: 1 Siswa memiliki banyak riwayat Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}