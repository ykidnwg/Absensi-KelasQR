<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('mahasiswa');
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas', 100);
            $table->string('kode_mata_kuliah', 50);
            $table->foreignId('dosen_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nim', 50)->unique();
            $table->foreignId('kelas_id')->constrained('kelas')->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('sesi_absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->restrictOnDelete();
            $table->string('judul', 150);
            $table->dateTime('mulai_at');
            $table->dateTime('berakhir_at');
            $table->string('token_hash');
            $table->string('status', 30)->default('aktif');
            $table->timestamps();
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_absensi_id')->constrained('sesi_absensi')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->dateTime('waktu_absen');
            $table->string('status', 30)->default('hadir');
            $table->timestamps();
            $table->unique(['sesi_absensi_id', 'mahasiswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('sesi_absensi');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('kelas');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
