
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Hadiriin</title>

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
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 27px;
        }

        .topbar p {
            color: #968998;
            font-size: 13px;
            margin-top: 8px;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .panel {
            background: #1b151e;
            border: 1px solid #342637;
            border-radius: 16px;
            padding: 25px;
        }

        .panel h2 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .panel .description {
            color: #a99daa;
            font-size: 13px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            color: #d9cbd9;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            background: #100c12;
            border: 1px solid #49364d;
            border-radius: 9px;
            color: #fff;
            outline: none;
            font-size: 13px;
        }

        input:focus {
            border-color: #f43a9b;
        }

        button {
            border: none;
            padding: 13px 20px;
            border-radius: 9px;
            background: linear-gradient(120deg, #e83291, #a52bd1);
            color: white;
            font-weight: 700;
            cursor: pointer;
            font-size: 13px;
        }

        button:hover {
            opacity: .9;
        }

        .message {
            background: #183c2b;
            border: 1px solid #28794d;
            color: #8ff0b4;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error {
            color: #ff7b91;
            font-size: 12px;
            margin-top: 7px;
        }

        .logout {
            margin-top: 30px;
            border-top: 1px solid #30232f;
            padding-top: 20px;
        }

        .logout button {
            width: 100%;
            background: #382034;
            color: #ff75b9;
        }

        @media(max-width: 900px) {
            .settings-grid {
                grid-template-columns: 1fr;
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

            .topbar h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">Hadir<span>iin.</span></div>

    <div class="menu-title">MENU UTAMA</div>

    <nav class="menu">
        <a href="{{ route('admin.dashboard') }}">▦ Dashboard</a>
        <a href="{{ route('admin.dosen.index') }}">♙ Data Dosen</a>
        <a href="{{ route('admin.mahasiswa.index') }}">♙ Data Mahasiswa</a>
        <a href="{{ route('admin.kelas.index') }}">▤ Data Kelas</a>
        <a href="{{ route('admin.rekap-absensi') }}">▣ Rekap Absensi</a>
        <a href="{{ route('admin.pengaturan') }}" class="active">⚙ Pengaturan</a>
    </nav>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Keluar dari Akun ↗</button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <h1>Pengaturan Admin</h1>
        <p>Kelola informasi akun dan keamanan sistem Hadiriin.</p>
    </header>

    @if(session('status'))
        <div class="message">{{ session('status') }}</div>
    @endif

    <div class="settings-grid">

        <section class="panel">
            <h2>Informasi Profil</h2>
            <p class="description">
                Perbarui nama dan alamat email akun administrator.
            </p>

            <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        required
                    >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Alamat Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        required
                    >
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Simpan Profil</button>
            </form>
        </section>

        <section class="panel">
            <h2>Keamanan Akun</h2>
            <p class="description">
                Ganti kata sandi secara berkala untuk menjaga keamanan akun.
            </p>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Kata Sandi Saat Ini</label>
                    <input
                        type="password"
                        name="current_password"
                        required
                    >
                    @error('current_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kata Sandi Baru</label>
                    <input
                        type="password"
                        name="password"
                        required
                    >
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Kata Sandi Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                    >
                </div>

                <button type="submit">Perbarui Kata Sandi</button>
            </form>
        </section>

    </div>

</main>

</body>
</html>
