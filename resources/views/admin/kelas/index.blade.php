
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - Hadiriin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0b12] text-white min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#11111b] border-r border-gray-800 p-6 hidden md:block">
            <h1 class="text-2xl font-bold text-pink-500 mb-10">Hadiriin.</h1>

            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="block text-gray-400 hover:text-pink-400">
                    Dashboard
                </a>

                <a href="{{ route('admin.dosen.index') }}"
                   class="block text-gray-400 hover:text-pink-400">
                    Data Dosen
                </a>

                <a href="{{ route('admin.mahasiswa.index') }}"
                   class="block text-gray-400 hover:text-pink-400">
                    Data Mahasiswa
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                   class="block text-pink-400 font-semibold">
                    Data Kelas
                </a>
            </nav>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-6 md:p-10">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold">Data Kelas</h2>
                    <p class="text-gray-400 mt-2">
                        Kelola data kelas dan dosen pengampu.
                    </p>
                </div>

                <a href="{{ route('admin.kelas.create') }}"
                   class="bg-pink-600 hover:bg-pink-500 px-5 py-3 rounded-xl font-semibold text-center">
                    + Tambah Kelas
                </a>
            </div>

            @if (session('status'))
    <div class="bg-green-500/10 border border-green-500 text-green-300 p-4 rounded-xl mb-6">
        {{ session('status') }}
    </div>
        @endif

            <div class="bg-[#151521] border border-gray-800 rounded-2xl overflow-hidden">

                <div class="p-5 border-b border-gray-800">
                    <h3 class="font-semibold text-lg">Daftar Kelas</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-[#1c1c2a] text-gray-400 text-sm">
                            <tr>
                                <th class="px-6 py-4">No.</th>
                                <th class="px-6 py-4">Nama Kelas</th>
                                <th class="px-6 py-4">Kode Mata Kuliah</th>
                                <th class="px-6 py-4">Dosen Pengampu</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-800">
                            @forelse ($daftarKelas as $index => $item)
                                <tr class="hover:bg-white/5">
                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $item->nama_kelas }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-300">
                                        {{ $item->kode_mata_kuliah }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-300">
                                        {{ $item->dosen->name ?? 'Belum ditentukan' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-3">
                                            <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                               class="text-blue-400 hover:text-blue-300">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.kelas.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-red-400 hover:text-red-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-10 text-center text-gray-400">
                                        Belum ada data kelas. Silakan tambahkan kelas terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>

</body>
</html>
