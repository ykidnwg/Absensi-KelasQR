<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('admin.mahasiswa.index', [
            'daftarMahasiswa' => Mahasiswa::with(['user', 'kelas'])->orderBy('nim')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.mahasiswa.create', ['daftarKelas' => Kelas::orderBy('nama_kelas')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nim' => ['required', 'string', 'max:50', 'unique:mahasiswa,nim'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ], [
            'name.required' => 'Nama mahasiswa wajib diisi.',
            'email.required' => 'Email mahasiswa wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak ditemukan.',
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'mahasiswa',
            ]);

            $user->mahasiswa()->create([
                'nim' => $data['nim'],
                'kelas_id' => $data['kelas_id'],
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('status', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');

        return view('admin.mahasiswa.edit', [
            'mhs' => $mahasiswa,
            'daftarKelas' => Kelas::orderBy('nama_kelas')->get(),
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($mahasiswa->user_id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'nim' => ['required', 'string', 'max:50', Rule::unique('mahasiswa')->ignore($mahasiswa->id)],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak ditemukan.',
        ]);

        DB::transaction(function () use ($data, $mahasiswa) {
            $mahasiswa->user->name = $data['name'];
            $mahasiswa->user->email = $data['email'];
            if (filled($data['password'] ?? null)) {
                $mahasiswa->user->password = $data['password'];
            }
            $mahasiswa->user->save();

            $mahasiswa->update([
                'nim' => $data['nim'],
                'kelas_id' => $data['kelas_id'],
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('status', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($mahasiswa) {
            $user = $mahasiswa->user;
            $mahasiswa->delete();
            $user?->delete();
        });

        return redirect()->route('admin.mahasiswa.index')->with('status', 'Data mahasiswa berhasil dihapus.');
    }
}
