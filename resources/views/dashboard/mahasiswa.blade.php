<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Hadiriin</title>

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

        .logout {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: 1px solid #63304e;
            border-radius: 10px;
            background: transparent;
            color: #ff54ad;
            cursor: pointer;
            font-size: 14px;
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
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .card {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 16px;
            padding: 24px;
        }

        .icon {
            color: #ff54ad;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .label {
            color: #a99daa;
            font-size: 13px;
        }

        .number {
            font-size: 32px;
            font-weight: 800;
            margin-top: 18px;
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
            line-height: 2;
        }

        .session-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .session-card {
            background: #1b151e;
            border: 1px solid #713052;
            border-radius: 14px;
            padding: 22px;
        }

        .session-card h4 {
            color: #ff54ad;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .session-card p {
            color: #a99daa;
            font-size: 13px;
            line-height: 1.9;
        }

        .status {
            display: inline-block;
            margin-top: 12px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #382034;
            color: #ff54ad;
            font-size: 11px;
        }

        .empty {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 14px;
            padding: 22px;
            color: #a99daa;
            font-size: 14px;
        }

        @media(max-width: 1000px) {
            .stats,
            .session-list {
                grid-template-columns: 1fr;
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

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .topbar {
                flex-wrap: wrap;
            }

            .stats,
            .session-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">Hadir<span>iin.</span></div>

        <div class="menu-title">MENU MAHASISWA</div>

        <nav class="menu">
            <a href="{{ route('mahasiswa.dashboard') }}" class="active">
                ▦ Dashboard
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Keluar dari Akun</button>
        </form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard Mahasiswa</h1>
                <p>Pantau informasi kelas dan aktivitas kehadiranmu.</p>
            </div>

            <div class="profile">
                Mahasiswa
            </div>
        </header>

        <section class="welcome">
            <h2>Halo, {{ auth()->user()->name }}! 👋</h2>
            <p>
                Selamat datang di Hadiriin.
                Pantau kehadiran perkuliahan dan sesi absensi
                kelas kamu melalui dashboard ini.
            </p>
        </section>

        <section class="stats">
            <div class="card">
                <div class="icon">♙</div>
                <div class="label">Identitas Mahasiswa</div>
                <div class="number" style="font-size: 23px;">
                    {{ $mhs->nim }}
                </div>
            </div>

            <div class="card">
                <div class="icon">◉</div>
                <div class="label">Total Kehadiran</div>
                <div class="number">{{ $jumlahKehadiran }}</div>
            </div>
        </section>

        <section class="section">
            <h3>Informasi Akademik</h3>

            <div class="info">
                <strong style="color: #fff;">Nama:</strong>
                {{ auth()->user()->name }}
                <br>

                <strong style="color: #fff;">NIM:</strong>
                {{ $mhs->nim }}
                <br>

                <strong style="color: #fff;">Kelas:</strong>
                {{ $mhs->kelas?->nama_kelas ?? '-' }}
            </div>
        </section>

        <section class="section">
            <h3>Sesi Absensi Aktif</h3>

            @forelse($sesiAktif as $sesi)
                <div class="session-card" style="margin-bottom: 15px;">
                    <h4>{{ $sesi->judul }}</h4>
                    <p>
                        Mulai:
                        {{ \Carbon\Carbon::parse($sesi->mulai_at)->format('d M Y, H:i') }}
                    </p>
                    <p>
                        Berakhir:
                        {{ \Carbon\Carbon::parse($sesi->berakhir_at)->format('d M Y, H:i') }}
                    </p>
                    <span class="status">Sesi sedang aktif</span>
                </div>
            @empty
                <div class="empty">
                    Belum ada sesi absensi aktif untuk kelas kamu.
                </div>
            @endforelse
        </section>

    </main>

</body>
</html>
