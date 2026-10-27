<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    protected $table = 'sesi_absensi';

    protected $fillable = ['kelas_id', 'judul', 'mulai_at', 'berakhir_at', 'token_hash', 'status'];

    protected function casts(): array
    {
        return ['mulai_at' => 'datetime', 'berakhir_at' => 'datetime'];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'sesi_absensi_id');
    }
}
