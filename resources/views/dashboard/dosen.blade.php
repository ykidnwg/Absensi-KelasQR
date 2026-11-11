<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - Hadiriin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #100c12;
            color: #fff;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #171119;
            border-right: 1px solid #30232f;
            padding: 30px 20px;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 55px;
        }

        .brand span {
            color: #f43a9b;
        }

        .menu-title {
            color: #827483;
            font-size: 11px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .menu a {
            display: block;
            color: #a99daa;
            text-decoration: none;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .menu a.active,
        .menu a:hover {
            background: #382034;
            color: #ff54ad;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .topbar h1 {
            font-size: 27px;
        }

        .topbar p {
            color: #968998;
            font-size: 13px;
            margin-top: 8px;
        }

        .profile {
            background: #251a28;
            padding: 12px 18px;
            border-radius: 12px;
            color: #ff54ad;
            font-size: 13px;
        }

        .welcome {
            background: linear-gradient(120deg, #54203f, #251427);
            border: 1px solid #713052;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .welcome h2 {
            font-size: 23px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #e3c8d9;
            font-size: 14px;
            line-height: 1.7;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 16px;
            padding: 24px;
        }

        .card .label {
            color: #a99daa;
            font-size: 13px;
        }

        .card .number {
            font-size: 32px;
            font-weight: 800;
            margin-top: 20px;
        }

        .card .icon {
            color: #ff54ad;
            font-size: 24px;
            margin-bottom: 12px;
        }

        .section {
            margin-top: 35px;
        }

        .section h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .class-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .class-card {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 14px;
            padding: 22px;
        }

        .class-card h4 {
            color: #ff54ad;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .class-card p {
            color: #a99daa;
            font-size: 13px;
            line-height: 1.8;
        }

        .empty {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 14px;
            padding: 25px;
            color: #a99daa;
            font-size: 14px;
        }

        @media(max-width: 1000px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 22px 18px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .menu a {
                display: inline-block;
                padding: 10px;
                margin-right: 4px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .stats,
            .class-list {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">Hadir<span>iin.</span></div>

        <div class="menu-title">MENU DOSEN</div>

        <nav class="menu">
            <a href="{{ route('dosen.dashboard') }}" class="active">▦ Dashboard</a>
        </nav>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard Dosen</h1>
                <p>Kelola kelas dan pantau aktivitas kehadiran mahasiswa.</p>
            </div>

            <div class="profile">
                {{ auth()->user()->name }}
            </div>
        </header>

        <section class="welcome">
            <h2>Halo, {{ auth()->user()->name }}! 👋</h2>
            <p>
                Selamat datang di Dashboard Dosen Hadiriin.
                Pantau kelas yang kamu ampu dan aktivitas absensi
                mahasiswa melalui satu tempat.
            </p>
        </section>

        <section class="stats">
            <div class="card">
                <div class="icon">▤</div>
                <div class="label">Kelas yang Diampu</div>
                <div class="number">{{ $daftarKelas->count() }}</div>
            </div>

            <div class="card">
                <div class="icon">♙</div>
                <div class="label">Total Mahasiswa</div>
                <div class="number">{{ $jumlahMahasiswa }}</div>
            </div>

            <div class="card">
                <div class="icon">◉</div>
                <div class="label">Sesi Absensi Aktif</div>
                <div class="number">{{ $jumlahSesiAktif }}</div>
            </div>
        </section>

        <section class="section">
            <h3>Daftar Kelas yang Diampu</h3>

            @if($daftarKelas->isEmpty())
                <div class="empty">
                    Belum ada kelas yang ditugaskan kepada akun dosen ini.
                </div>
            @else
                <div class="class-list">
                    @foreach($daftarKelas as $kelas)
                        <div class="class-card">
                            <h4>{{ $kelas->nama_kelas }}</h4>
                            <p>
                                Kode Mata Kuliah:
                                {{ $kelas->kode_mata_kuliah ?? '-' }}
                            </p>
                            <p>
                                Jumlah Mahasiswa:
                                {{ $kelas->mahasiswa_count ?? $kelas->mahasiswa()->count() }}
                            </p>
                            <p>
                                Sesi Absensi Aktif:
                                {{ $kelas->sesiAbsensi->count() }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </main>

</body>
</html>
