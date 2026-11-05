
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Hadiriin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b090b] text-white min-h-screen">

    <aside class="fixed left-0 top-0 w-64 min-h-screen bg-[#190b17] border-r border-pink-900/30 p-6">
        <h1 class="text-2xl font-bold mb-16">
            Hadiri<span class="text-pink-500">in.</span>
        </h1>

        <p class="text-xs text-gray-500 mb-5">MENU UTAMA</p>

        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 text-gray-400 hover:bg-pink-900/30 rounded-lg">Dashboard</a>
            <a href="{{ route('admin.dosen.index') }}" class="block p-3 text-gray-400 hover:bg-pink-900/30 rounded-lg">Data Dosen</a>
            <a href="{{ route('admin.mahasiswa.index') }}" class="block p-3 bg-pink-900/40 text-pink-400 rounded-lg">Data Mahasiswa</a>
            <a href="{{ route('admin.kelas.index') }}" class="block p-3 text-gray-400 hover:bg-pink-900/30 rounded-lg">Data Kelas</a>
        </nav>
    </aside>

    <main class="ml-64 p-9">
        <div class="flex justify-between items-center mb-9">
            <div>
                <h2 class="text-3xl font-bold">Data Mahasiswa</h2>
                <p class="text-gray-400 mt-2">Kelola seluruh data mahasiswa Hadiriin.</p>
            </div>

            <a href="{{ route('admin.mahasiswa.create') }}"
               class="bg-pink-600 hover:bg-pink-500 px-5 py-3 rounded-xl font-semibold">
                + Tambah Mahasiswa
            </a>
        </div>

        @if(session('status'))
            <div class="bg-green-900/40 border border-green-700 p-4 rounded-xl mb-5">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-900/40 border border-red-700 p-4 rounded-xl mb-5">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-[#21151f] border border-pink-900/40 rounded-2xl overflow-hidden">
            <div class="p-5 border-b border-pink-900/30">
                <h3 class="font-bold text-lg">Daftar Mahasiswa</h3>
                <p class="text-sm text-gray-400 mt-1">Data akun dan kelas mahasiswa.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#301b2c] text-gray-300 text-sm">
                        <tr>
                            <th class="p-4">No.</th>
                            <th class="p-4">NIM</th>
                            <th class="p-4">Nama</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarMahasiswa as $index => $mhs)
                            <tr class="border-t border-pink-900/20 hover:bg-pink-900/10">
                                <td class="p-4">{{ $daftarMahasiswa->firstItem() + $index }}</td>
                                <td class="p-4">{{ $mhs->nim }}</td>
                                <td class="p-4">{{ $mhs->user->name ?? '-' }}</td>
                                <td class="p-4">{{ $mhs->user->email ?? '-' }}</td>
                                <td class="p-4">{{ $mhs->kelas->nama_kelas ?? '-' }}</td>
                                <td class="p-4 whitespace-nowrap">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs) }}"
                                       class="text-pink-400 hover:text-pink-300 mr-3">Edit</a>

                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5">
                {{ $daftarMahasiswa->links() }}
            </div>
        </div>
    </main>

</body>
</html>
