
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - Hadiriin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b090b] text-white min-h-screen">

    <aside class="fixed left-0 top-0 w-64 min-h-screen bg-[#190b17] border-r border-pink-900/30 p-6">
        <h1 class="text-2xl font-bold mb-16">
            Hadiri<span class="text-pink-500">in.</span>
        </h1>

        <p class="text-xs text-gray-500 mb-5">MENU UTAMA</p>

        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 text-gray-400 rounded-lg">Dashboard</a>
            <a href="{{ route('admin.dosen.index') }}" class="block p-3 text-gray-400 rounded-lg">Data Dosen</a>
            <a href="{{ route('admin.mahasiswa.index') }}" class="block p-3 bg-pink-900/40 text-pink-400 rounded-lg">Data Mahasiswa</a>
            <a href="{{ route('admin.kelas.index') }}" class="block p-3 text-gray-400 rounded-lg">Data Kelas</a>
        </nav>
    </aside>

    <main class="ml-64 p-9">
        <div class="mb-8">
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-pink-400 hover:text-pink-300">
                ← Kembali ke Data Mahasiswa
            </a>
            <h2 class="text-3xl font-bold mt-5">Tambah Mahasiswa</h2>
            <p class="text-gray-400 mt-2">Masukkan informasi akun dan data akademik mahasiswa.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-900/40 border border-red-700 p-4 rounded-xl mb-6">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="max-w-3xl bg-[#21151f] border border-pink-900/40 rounded-2xl p-7">
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap"
                               required
                               class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}"
                               placeholder="Masukkan NIM"
                               required
                               class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="contoh@email.com"
                               required
                               class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">Password</label>
                        <input type="password" name="password"
                               placeholder="Minimal 8 karakter"
                               required
                               class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               placeholder="Ulangi password"
                               required
                               class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-300 mb-2">Kelas</label>
                        <select name="kelas_id" required
                                class="w-full bg-[#120d12] border border-pink-900/40 rounded-xl p-3 outline-none focus:border-pink-500">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($daftarKelas as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }} - {{ $kelas->kode_mata_kuliah }}
                                </option>
                            @endforeach
                        </select>

                        @if($daftarKelas->isEmpty())
                            <p class="text-yellow-400 text-sm mt-2">
                                Belum ada kelas. Buat kelas terlebih dahulu sebelum menambahkan mahasiswa.
                            </p>
                        @endif
                    </div>

                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                            @if($daftarKelas->isEmpty()) disabled @endif
                            class="bg-pink-600 hover:bg-pink-500 disabled:opacity-40 px-6 py-3 rounded-xl font-semibold">
                        Simpan Mahasiswa
                    </button>

                    <a href="{{ route('admin.mahasiswa.index') }}"
                       class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded-xl">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
