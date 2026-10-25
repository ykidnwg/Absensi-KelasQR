<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Mahasiswa (Ganti 'mahasiswas' jika nama tabel kamu 'students')
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade'); 
            
            // Relasi ke Matakuliah
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            
            // Tambahan untuk Perkuliahan
            $table->integer('pertemuan_ke')->default(1); // Catatan pertemuan ke-1, 2, dst.
            $table->timestamp('scanned_at');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
            $table->text('keterangan')->nullable(); // Catatan tambahan (misal: surat izin)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};