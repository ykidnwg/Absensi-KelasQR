<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: 1 Matkul memiliki banyak riwayat Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}