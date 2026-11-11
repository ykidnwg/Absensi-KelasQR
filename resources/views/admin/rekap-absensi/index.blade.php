
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi - Hadiriin</title>

    <style>
        
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #0f0b18;
    color: #f5f3fa;
}

.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #171323;
    color: white;
    padding: 28px 18px;
    border-right: 1px solid #30263f;
}

.brand {
    font-size: 25px;
    font-weight: bold;
    margin: 5px 10px 40px;
}

.brand span {
    color: #ec4899;
}

.menu-title {
    color: #9b95aa;
    font-size: 11px;
    margin: 20px 12px 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.menu a {
    display: block;
    padding: 13px 14px;
    margin-bottom: 7px;
    color: #c9c4d4;
    text-decoration: none;
    border-radius: 9px;
    font-size: 14px;
}

.menu a:hover,
.menu a.active {
    background: linear-gradient(100deg, #9333ea, #ec4899);
    color: white;
}

.logout {
    position: absolute;
    bottom: 25px;
    left: 18px;
    right: 18px;
}

.logout button {
    width: 100%;
    padding: 12px;
    border: 1px solid #51465f;
    border-radius: 9px;
    background: transparent;
    color: white;
    cursor: pointer;
}

.main {
    margin-left: 250px;
    padding: 35px;
    min-height: 100vh;
    background: #0f0b18;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    gap: 15px;
}

.header h1 {
    font-size: 27px;
    margin-bottom: 8px;
    color: #ffffff;
}

.header p {
    color: #a49bb5;
    font-size: 14px;
}

.admin-label {
    background: #38203e;
    color: #f472b6;
    padding: 10px 16px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: bold;
}

.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}

.stat-card,
.content-card {
    background: #1b1628;
    padding: 24px;
    border-radius: 15px;
    border: 1px solid #30263f;
    box-shadow: 0 4px 18px rgba(0, 0, 0, .15);
}

.stat-card p {
    color: #aaa1b9;
    font-size: 13px;
    margin-bottom: 14px;
}

.stat-card h2 {
    font-size: 29px;
    color: #ffffff;
}

.stat-card small {
    display: block;
    margin-top: 8px;
    color: #958ba7;
}

.content-card {
    padding: 25px;
}

.content-header {
    margin-bottom: 22px;
}

.content-header h2 {
    font-size: 19px;
    margin-bottom: 7px;
    color: #ffffff;
}

.content-header p {
    color: #a49bb5;
    font-size: 13px;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 850px;
}

th {
    background: #282035;
    color: #c4b5d8;
    font-size: 12px;
    text-align: left;
    padding: 15px 12px;
    white-space: nowrap;
}

td {
    padding: 16px 12px;
    border-bottom: 1px solid #30263f;
    font-size: 13px;
    color: #e3ddec;
}

.status {
    display: inline-block;
    padding: 6px 11px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: bold;
    background: #16452f;
    color: #86efac;
}

.status-other {
    background: #51212d;
    color: #fda4af;
}

.empty {
    text-align: center;
    padding: 40px 15px;
    color: #a49bb5;
}

.pagination {
    margin-top: 20px;
}

.pagination nav {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 8px 12px;
    margin: 2px;
    border-radius: 7px;
    background: #38203e;
    color: #f0abfc;
    text-decoration: none;
    font-size: 12px;
}

@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 18px;
    }

    .brand {
        margin: 5px 5px 18px;
    }

    .menu-title {
        margin-top: 15px;
    }

    .menu a {
        display: inline-block;
        margin: 3px;
        padding: 10px;
        font-size: 12px;
    }

    .logout {
        position: static;
        margin-top: 15px;
    }

    .main {
        margin-left: 0;
        padding: 20px 15px;
    }

    .header {
        align-items: flex-start;
    }

    .header h1 {
        font-size: 22px;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    .content-card {
        padding: 16px;
    }
}

    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">Hadir<span>iin.</span></div>

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}">▦ Dashboard</a>
            <a href="{{ route('admin.dosen.index') }}">♙ Data Dosen</a>
            <a href="{{ route('admin.mahasiswa.index') }}">♙ Data Mahasiswa</a>
            <a href="{{ route('admin.kelas.index') }}">▤ Data Kelas</a>
            <a href="{{ route('admin.rekap-absensi') }}" class="active">▣ Rekap Absensi</a>
        </nav>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">↪ Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main">

        <header class="header">
            <div>
                <h1>Rekap Absensi</h1>
                <p>Pantau dan lihat seluruh riwayat kehadiran mahasiswa.</p>
            </div>

            <div class="admin-label">Administrator</div>
        </header>

        <section class="stats">
            <div class="stat-card">
                <p>Total Data Absensi</p>
                <h2>{{ $jumlahAbsensi }}</h2>
                <small>Seluruh catatan kehadiran</small>
            </div>

            <div class="stat-card">
                <p>Total Hadir</p>
                <h2>{{ $jumlahHadir }}</h2>
                <small>Mahasiswa tercatat hadir</small>
            </div>

            <div class="stat-card">
                <p>Selain Status Hadir</p>
                <h2>{{ $jumlahTidakHadir }}</h2>
                <small>Catatan dengan status selain hadir</small>
            </div>
        </section>

        <section class="content-card">
            <div class="content-header">
                <h2>Daftar Riwayat Absensi</h2>
                <p>Data absensi mahasiswa yang tersimpan di sistem Hadiriin.</p>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>Sesi Absensi</th>
                            <th>Waktu Absen</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($daftarAbsensi as $index => $absen)
                            <tr>
                                <td>{{ $daftarAbsensi->firstItem() + $index }}</td>
                                <td>{{ $absen->mahasiswa?->user?->name ?? '-' }}</td>
                                <td>{{ $absen->mahasiswa?->nim ?? '-' }}</td>
                                <td>{{ $absen->mahasiswa?->kelas?->nama_kelas ?? '-' }}</td>
                                <td>{{ $absen->sesiAbsensi?->judul ?? '-' }}</td>
                                <td>
                                    {{ $absen->waktu_absen?->format('d/m/Y H:i') ?? '-' }}
                                </td>
                                <td>
                                    @if ($absen->status === 'hadir')
                                        <span class="status">Hadir</span>
                                    @else
                                        <span class="status status-other">
                                            {{ ucfirst($absen->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    Belum ada data absensi yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $daftarAbsensi->links() }}
            </div>
        </section>

    </main>

</body>
</html>
