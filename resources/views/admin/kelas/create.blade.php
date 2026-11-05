
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas - Hadiriin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0b12] text-white min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#11111b] border-r border-gray-800 p-6 hidden md:block">
            <h1 class="text-2xl font-bold text-pink-500 mb-10">Hadiriin.</h1>

            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="block text-gray-400 hover:text-pink-400">Dashboard</a>

                <a href="{{ route('admin.dosen.index') }}"
                   class="block text-gray-400 hover:text-pink-400">Data Dosen</a>

                <a href="{{ route('admin.mahasiswa.index') }}"
                   class="block text-gray-400 hover:text-pink-400">Data Mahasiswa</a>

                <a href="{{ route('admin.kelas.index') }}"
                   class="block text-pink-400 font-semibold">Data Kelas</a>
            </nav>
        </aside>

        <!-- Konten -->
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-3xl mx-auto">

                <a href="{{ route('admin.kelas.index') }}"
                   class="text-pink-400 hover:text-pink-300 text-sm">
                    ← Kembali ke Data Kelas
                </a>

                <h2 class="text-3xl font-bold mt-5 mb-2">Tambah Kelas</h2>
                <p class="text-gray-400 mb-8">
                    Masukkan informasi kelas dan dosen pengampu.
                </p>

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500 text-red-300 p-4 rounded-xl mb-6">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kelas.store') }}"
                      method="POST"
                      class="bg-[#151521] border border-gray-800 rounded-2xl p-6 space-y-5">

                    @csrf

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Nama Kelas
                        </label>
                        <input type="text"
                               name="nama_kelas"
                               value="{{ old('nama_kelas') }}"
                               required
                               placeholder="Contoh: Teknik Informatika 24C"
                               class="w-full bg-[#0b0b12] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Kode Mata Kuliah
                        </label>
                        <input type="text"
                               name="kode_mata_kuliah"
                               value="{{ old('kode_mata_kuliah') }}"
                               required
                               placeholder="Contoh: IF101"
                               class="w-full bg-[#0b0b12] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Dosen Pengampu
                        </label>

                        <select name="dosen_id"
                                required
                                class="w-full bg-[#0b0b12] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-pink-500">

                            <option value="">-- Pilih Dosen --</option>

                            @foreach (($daftarDosen ?? $dosen ?? collect()) as $itemDosen)
                                <option value="{{ $itemDosen->id }}"
                                    {{ old('dosen_id') == $itemDosen->id ? 'selected' : '' }}>
                                    {{ $itemDosen->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('admin.kelas.index') }}"
                           class="px-5 py-3 rounded-xl bg-gray-700 hover:bg-gray-600">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-5 py-3 rounded-xl bg-pink-600 hover:bg-pink-500 font-semibold">
                            Simpan Kelas
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

</body>
</html>
