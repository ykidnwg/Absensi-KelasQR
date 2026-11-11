
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Hadiriin</title>

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
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
        }

        .section {
            margin-top: 35px;
        }

        .section h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .info {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 14px;
            padding: 22px;
            color: #a99daa;
            font-size: 14px;
            line-height: 1.8;
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
            }

            .brand {
                margin-bottom: 20px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .topbar {
                gap: 15px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">Hadir<span>iin.</span></div>

        <div class="menu-title">MENU UTAMA</div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}" class="active">▦ Dashboard</a>
            <a href="{{ route('admin.dosen.index') }}">♙ Data Dosen</a>
            <a href="{{ route('admin.mahasiswa.index') }}">♙ Data Mahasiswa</a>
            <a href="{{ route('admin.kelas.index') }}">▤ Data Kelas</a>
            <a href="{{ route('admin.rekap-absensi') }}">▣ Rekap Absensi</a>
            <a href="{{ route('admin.pengaturan') }}">⚙ Pengaturan</a>
        </nav>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang di sistem manajemen Hadiriin.</p>
            </div>

            <div class="profile">
                Administrator
            </div>
        </header>

        <section class="welcome">
            <h2>Halo, Admin! 👋</h2>
            <p>
                Pantau aktivitas perkuliahan dan kelola
                sistem kehadiran kampus melalui satu tempat.
            </p>
        </section>

        <section class="stats">

            <div class="card">
                <div class="icon">♙</div>
                <div class="label">Total Dosen</div>
                <div class="number">{{ $jumlahDosen }}</div>
            </div>

            <div class="card">
                <div class="icon">♧</div>
                <div class="label">Total Mahasiswa</div>
                <div class="number">{{ $jumlahMahasiswa }}</div>
            </div>

            <div class="card">
                <div class="icon">▤</div>
                <div class="label">Total Kelas</div>
                <div class="number">{{ $jumlahKelas }}</div>
            </div>

            <div class="card">
                <div class="icon">◉</div>
                <div class="label">Sesi Absensi Aktif</div>
                <div class="number">{{ $jumlahSesiAktif }}</div>
            </div>

        </section>

        <section class="section">
            <h3>Informasi Sistem</h3>

            <div class="info">
                Sistem Hadiriin digunakan untuk mengelola
                data dosen, mahasiswa, kelas, dan aktivitas
                absensi menggunakan teknologi QR Code.

                <br><br>

                Pastikan data akademik selalu diperbarui
                agar proses absensi berjalan dengan baik.
            </div>
        </section>

    </main>

</body>
</html>
