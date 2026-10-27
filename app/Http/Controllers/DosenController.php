<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.dosen.index', [
            'daftarDosen' => User::where('role', 'dosen')->withCount('kelasDiampu')->orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama dosen wajib diisi.',
            'email.required' => 'Email dosen wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
        ]);

        $data['role'] = 'dosen';
        User::create($data);

        return redirect()->route('admin.dosen.index')->with('status', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(User $dosen)
    {
        abort_unless($dosen->role === 'dosen', 404);

        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, User $dosen)
    {
        abort_unless($dosen->role === 'dosen', 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($dosen->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }
        $dosen->update($data);

        return redirect()->route('admin.dosen.index')->with('status', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(User $dosen)
    {
        abort_unless($dosen->role === 'dosen', 404);
        if (Kelas::where('dosen_id', $dosen->id)->exists()) {
            return back()->withErrors(['dosen' => 'Dosen masih tercatat mengampu kelas. Pindahkan dosen terlebih dahulu.']);
        }

        DB::transaction(fn () => $dosen->delete());

        return redirect()->route('admin.dosen.index')->with('status', 'Data dosen berhasil dihapus.');
    }
}
