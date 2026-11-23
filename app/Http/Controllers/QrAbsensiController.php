<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class QrAbsensiController extends Controller
{
    public function dosenIndex(Request $request)
    {
        $kelas = Kelas::where('dosen_id', $request->user()->id)->get();
        $sesi = SesiAbsensi::whereIn('kelas_id', $kelas->pluck('id'))
            ->with('kelas')->latest('id')->limit(30)->get();
        return view('qr.dosen', compact('kelas', 'sesi'));
    }

    public function buat(Request $request)
    {
        $data = $request->validate([
            'kelas_id' => 'required|integer',
            'judul' => 'required|string|max:150',
            'durasi' => 'required|integer|min:5|max:240',
        ]);
        $kelas = Kelas::where('dosen_id', $request->user()->id)->findOrFail($data['kelas_id']);
        $sesi = SesiAbsensi::create([
            'kelas_id' => $kelas->id, 'judul' => $data['judul'],
            'mulai_at' => now(), 'berakhir_at' => now()->addMinutes((int) $data['durasi']),
            'token_hash' => hash('sha256', Str::random(64)), 'status' => 'aktif',
        ]);
        return redirect()->route('dosen.qr.tampil', $sesi);
    }

    private function milikDosen(Request $request, SesiAbsensi $sesi): void
    {
        abort_unless(Kelas::where('id', $sesi->kelas_id)->where('dosen_id', $request->user()->id)->exists(), 403);
    }

    public function tampil(Request $request, SesiAbsensi $sesi)
    {
        $this->milikDosen($request, $sesi);
        return view('qr.tampil', compact('sesi'));
    }

    public function token(Request $request, SesiAbsensi $sesi)
    {
        $this->milikDosen($request, $sesi);
        abort_unless($sesi->status === 'aktif' && now()->betweenIncluded($sesi->mulai_at, $sesi->berakhir_at), 410, 'Sesi sudah berakhir.');
        $slot = intdiv(now()->timestamp, 15);
        $signature = hash_hmac('sha256', $sesi->id . ':' . $slot, $sesi->token_hash . config('app.key'));
        return response()->json([
            'payload' => $sesi->id . ':' . $slot . ':' . $signature,
            'seconds_left' => 15 - (now()->timestamp % 15),
        ])->header('Cache-Control', 'no-store');
    }

    public function tutup(Request $request, SesiAbsensi $sesi)
    {
        $this->milikDosen($request, $sesi);
        $sesi->update(['status' => 'selesai', 'berakhir_at' => now()]);
        return redirect()->route('dosen.qr.index')->with('success', 'Sesi absensi ditutup.');
    }

    public function mahasiswaIndex(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', $request->user()->id)->firstOrFail();
        $riwayat = Absensi::where('mahasiswa_id', $mahasiswa->id)->with('sesiAbsensi')->latest('id')->limit(20)->get();
        return view('qr.mahasiswa', compact('mahasiswa', 'riwayat'));
    }

    public function scan(Request $request)
    {
        $data = $request->validate(['qr' => 'required|string|max:300']);
        $parts = explode(':', trim($data['qr']));
        if (count($parts) !== 3 || !ctype_digit($parts[0]) || !ctype_digit($parts[1]) || !preg_match('/^[a-f0-9]{64}$/', $parts[2])) {
            throw ValidationException::withMessages(['qr' => 'Format QR tidak valid.']);
        }
        [$id, $slot, $signature] = $parts;
        $mahasiswa = Mahasiswa::where('user_id', $request->user()->id)->firstOrFail();
        DB::transaction(function () use ($id, $slot, $signature, $mahasiswa) {
            $sesi = SesiAbsensi::whereKey($id)->lockForUpdate()->first();
            if (!$sesi || $sesi->kelas_id !== $mahasiswa->kelas_id || $sesi->status !== 'aktif'
                || !now()->betweenIncluded($sesi->mulai_at, $sesi->berakhir_at)) {
                throw ValidationException::withMessages(['qr' => 'Sesi tidak aktif atau bukan kelas Anda.']);
            }
            $currentSlot = intdiv(now()->timestamp, 15);
            if ((int) $slot !== $currentSlot) {
                throw ValidationException::withMessages(['qr' => 'QR kedaluwarsa. Silakan scan QR terbaru.']);
            }
            $expected = hash_hmac('sha256', $sesi->id . ':' . $slot, $sesi->token_hash . config('app.key'));
            if (!hash_equals($expected, $signature)) {
                throw ValidationException::withMessages(['qr' => 'QR tidak sah.']);
            }
            if (Absensi::where('sesi_absensi_id', $sesi->id)->where('mahasiswa_id', $mahasiswa->id)->exists()) {
                throw ValidationException::withMessages(['qr' => 'Anda sudah absen pada sesi ini.']);
            }
            Absensi::create(['sesi_absensi_id' => $sesi->id, 'mahasiswa_id' => $mahasiswa->id,
                'waktu_absen' => now(), 'status' => 'hadir']);
        });
        return redirect()->route('mahasiswa.qr.index')->with('success', 'Absensi berhasil dicatat!');
    }
}
