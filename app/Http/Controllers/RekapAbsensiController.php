<?php

namespace App\Http\Controllers;

use App\Models\Absensi;

class RekapAbsensiController extends Controller
{
    public function index()
    {
        $daftarAbsensi = Absensi::with([
            'mahasiswa.user',
            'mahasiswa.kelas',
            'sesiAbsensi.kelas',
        ])
            ->latest('waktu_absen')
            ->paginate(15);

        return view('admin.rekap-absensi.index', [
            'daftarAbsensi' => $daftarAbsensi,
            'jumlahAbsensi' => Absensi::count(),
            'jumlahHadir' => Absensi::where('status', 'hadir')->count(),
            'jumlahTidakHadir' => Absensi::where('status', '!=', 'hadir')->count(),
        ]);
    }
}
