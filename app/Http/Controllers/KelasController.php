<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index', [
            'daftarKelas' => Kelas::with('dosen')->withCount('mahasiswa')->orderBy('nama_kelas')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.kelas.create', ['daftarDosen' => User::where('role', 'dosen')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:100'],
            'kode_mata_kuliah' => ['required', 'string', 'max:50'],
            'dosen_id' => ['required', 'exists:users,id'],
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'kode_mata_kuliah.required' => 'Kode mata kuliah wajib diisi.',
            'dosen_id.required' => 'Dosen pengampu wajib dipilih.',
            'dosen_id.exists' => 'Dosen yang dipilih tidak ditemukan.',
        ]);
        if (User::whereKey($data['dosen_id'])->where('role', 'dosen')->doesntExist()) {
            return back()->withErrors(['dosen_id' => 'Akun yang dipilih bukan dosen.'])->withInput();
        }

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('status', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', [
            'kelas' => $kelas,
            'daftarDosen' => User::where('role', 'dosen')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:100'],
            'kode_mata_kuliah' => ['required', 'string', 'max:50'],
            'dosen_id' => ['required', 'exists:users,id'],
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'kode_mata_kuliah.required' => 'Kode mata kuliah wajib diisi.',
            'dosen_id.required' => 'Dosen pengampu wajib dipilih.',
            'dosen_id.exists' => 'Dosen yang dipilih tidak ditemukan.',
        ]);
        if (User::whereKey($data['dosen_id'])->where('role', 'dosen')->doesntExist()) {
            return back()->withErrors(['dosen_id' => 'Akun yang dipilih bukan dosen.'])->withInput();
        }

        $kelas->update($data);

        return redirect()->route('admin.kelas.index')->with('status', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        if ($kelas->mahasiswa()->exists() || $kelas->sesiAbsensi()->exists()) {
            return back()->withErrors(['kelas' => 'Kelas masih memiliki mahasiswa atau sesi absensi.']);
        }

        DB::transaction(fn () => $kelas->delete());

        return redirect()->route('admin.kelas.index')->with('status', 'Data kelas berhasil dihapus.');
    }
}
