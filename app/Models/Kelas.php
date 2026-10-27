<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['nama_kelas', 'kode_mata_kuliah', 'dosen_id'];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id');
    }

    public function sesiAbsensi()
    {
        return $this->hasMany(SesiAbsensi::class, 'kelas_id');
    }
}
