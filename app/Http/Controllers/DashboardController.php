<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\SesiAbsensi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'jumlahDosen' => User::where('role', 'dosen')->count(),
            'jumlahMahasiswa' => Mahasiswa::count(),
            'jumlahKelas' => Kelas::count(),
            'jumlahSesiAktif' => SesiAbsensi::where('status', 'aktif')
                ->where('mulai_at', '<=', now())->where('berakhir_at', '>=', now())->count(),
        ]);
    }

    public function dosen(Request $request)
    {
        $daftarKelas = Kelas::withCount('mahasiswa')
            ->where('dosen_id', $request->user()->id)
            ->with(['sesiAbsensi' => fn ($query) => $query->where('status', 'aktif')
                ->where('mulai_at', '<=', now())->where('berakhir_at', '>=', now())])
            ->get();

        return view('dashboard.dosen', [
            'daftarKelas' => $daftarKelas,
            'jumlahMahasiswa' => Mahasiswa::whereIn('kelas_id', $daftarKelas->pluck('id'))->count(),
            'jumlahSesiAktif' => $daftarKelas->sum(fn ($kelas) => $kelas->sesiAbsensi->count()),
        ]);
    }

    public function mahasiswa(Request $request)
    {
        $mhs = Mahasiswa::with('kelas')
            ->withCount('absensi')
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return view('dashboard.mahasiswa', [
            'mhs' => $mhs,
            'jumlahKehadiran' => $mhs->absensi_count,
            'sesiAktif' => SesiAbsensi::where('kelas_id', $mhs->kelas_id)
                ->where('status', 'aktif')->where('mulai_at', '<=', now())
                ->where('berakhir_at', '>=', now())->latest('mulai_at')->get(),
        ]);
    }
}
