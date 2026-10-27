<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
            'identitas' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'role.required' => 'Silakan pilih jenis akun.',
            'role.in' => 'Jenis akun tidak valid.',
            'identitas.required' => 'Email atau NIM wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $kredensial = filter_var($data['identitas'], FILTER_VALIDATE_EMAIL)
            ? ['email' => $data['identitas'], 'password' => $data['password']]
            : null;

        if ($data['role'] === 'mahasiswa' && ! $kredensial) {
            $mahasiswa = \App\Models\Mahasiswa::with('user')->where('nim', $data['identitas'])->first();
            if ($mahasiswa?->user) {
                $kredensial = ['email' => $mahasiswa->user->email, 'password' => $data['password']];
            }
        }

        if (! $kredensial || ! Auth::attempt($kredensial)) {
            return back()->withErrors(['identitas' => 'Email/NIM atau kata sandi tidak sesuai.'])->onlyInput('identitas', 'role');
        }

        if (Auth::user()->role !== $data['role']) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['role' => 'Jenis akun yang dipilih tidak sesuai.'])->onlyInput('identitas', 'role');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.' . Auth::user()->role);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda berhasil keluar.');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',
        ]);

        $user->update($data);

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak sama.',
        ]);

        $request->user()->update(['password' => $data['password']]);

        return back()->with('status', 'Kata sandi berhasil diperbarui.');
    }
}
