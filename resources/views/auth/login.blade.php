
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hadiriin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #0b090d;
            color: #fff;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        .left {
            position: relative;
            overflow: hidden;
            padding: 45px 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background:
                radial-gradient(circle at 40% 48%,
                rgba(225, 30, 126, .18),
                transparent 55%),
                linear-gradient(135deg, #1b101a, #100c12);
            border-right: 1px solid #30202d;
        }

        .left::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(255, 70, 165, .17);
            border-radius: 50%;
            top: 29%;
            left: 16%;
            box-shadow:
                0 0 0 45px rgba(255, 70, 165, .025),
                0 0 0 90px rgba(255, 70, 165, .02);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 13px;
            background: linear-gradient(135deg, #ff64b5, #ec168a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
            color: #250d1c;
            box-shadow: 0 5px 25px rgba(236, 22, 138, .3);
        }

        .brand-name {
            font-size: 23px;
            font-weight: bold;
        }

        .brand-name span {
            color: #fa42a4;
        }

        .hero {
            position: relative;
            z-index: 1;
            max-width: 590px;
            margin-top: 30px;
        }

        .tagline {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 30px;
            border: 1px solid rgba(255, 75, 166, .25);
            background: rgba(255, 50, 150, .08);
            color: #ff79bb;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 28px;
        }

        .hero h1 {
            font-size: clamp(38px, 4.2vw, 65px);
            line-height: 1.13;
            letter-spacing: -2px;
            margin-bottom: 27px;
        }

        .hero h1 span {
            color: #f344a3;
        }

        .hero p {
            color: #a99eaa;
            font-size: 15px;
            line-height: 1.8;
            max-width: 470px;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 34px;
        }

        .feature {
            padding: 13px 15px;
            border: 1px solid #382532;
            background: rgba(255, 255, 255, .035);
            border-radius: 13px;
            font-size: 12px;
            color: #e5dce5;
        }

        .copyright {
            position: relative;
            z-index: 1;
            color: #837985;
            font-size: 12px;
        }

        .right {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 45px;
            background: #0b090d;
        }

        .login-box {
            width: 100%;
            max-width: 430px;
        }

        .welcome {
            color: #f344a3;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 18px;
        }

        .login-box h2 {
            font-size: 36px;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .login-description {
            color: #a99eaa;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 38px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 11px;
            color: #e9e1e9;
        }

        input, select {
            width: 100%;
            height: 55px;
            padding: 0 16px;
            border: 1px solid #332934;
            border-radius: 14px;
            background: #151117;
            color: white;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        input::placeholder {
            color: #716775;
        }

        input:focus, select:focus {
            border-color: #ef399c;
            box-shadow: 0 0 0 3px rgba(239, 57, 156, .08);
        }

        select option {
            background: #151117;
            color: white;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 90px;
        }

        .show-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #e6b5d0;
            cursor: pointer;
            font-size: 12px;
        }

        .error {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            background: rgba(255, 60, 90, .1);
            color: #ff8a9b;
            font-size: 13px;
        }

        .submit-btn {
            width: 100%;
            height: 57px;
            margin-top: 6px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(90deg, #ff4da9, #e91e91);
            color: #260b1b;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: .2s;
            box-shadow: 0 8px 25px rgba(233, 30, 145, .17);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(233, 30, 145, .3);
        }

        .submit-btn span {
            margin-left: 10px;
            font-size: 18px;
        }

        .login-footer {
            margin-top: 29px;
            text-align: center;
            color: #837985;
            font-size: 12px;
            line-height: 1.9;
        }

        .login-footer strong {
            color: #f36eae;
        }

        @media (max-width: 850px) {
            .container {
                grid-template-columns: 1fr;
            }

            .left {
                min-height: 440px;
                padding: 30px;
            }

            .hero {
                margin: 65px 0 40px;
            }

            .right {
                padding: 55px 25px;
            }
        }

        @media (max-width: 480px) {
            .left {
                min-height: 390px;
                padding: 25px;
            }

            .hero h1 {
                font-size: 39px;
            }

            .login-box h2 {
                font-size: 30px;
            }

            .right {
                padding: 45px 22px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <section class="left">

        <div class="brand">
            <div class="brand-icon">H</div>
            <div class="brand-name">hadirin<span>.</span></div>
        </div>

        <div class="hero">
            <div class="tagline">● SMART ATTENDANCE SYSTEM</div>

            <h1>
                Kehadiran jadi<br>
                <span>lebih simpel.</span>
            </h1>

            <p>
                Satu tempat untuk mengelola kehadiran, memantau
                aktivitas, dan membuat administrasi kampus lebih praktis.
            </p>

            <div class="features">
                <div class="feature">QR Code Attendance</div>
                <div class="feature">Real-time Monitoring</div>
                <div class="feature">Digital Recap</div>
            </div>
        </div>

        <div class="copyright">
            © 2026 Hadiriin. Made for a smarter campus.
        </div>

    </section>

    <section class="right">

        <div class="login-box">

            <div class="welcome">WELCOME BACK!</div>

            <h2>Login ke Hadirin</h2>

            <p class="login-description">
                Masuk ke akunmu untuk melanjutkan aktivitas kehadiran.
            </p>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="role">Masuk sebagai</label>
                    <select name="role" id="role" required>
                        <option value="mahasiswa" {{ old('role', 'mahasiswa') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="identitas">Email atau NIM</label>
                    <input
                        type="text"
                        id="identitas"
                        name="identitas"
                        value="{{ old('identitas') }}"
                        placeholder="Masukkan email atau NIM"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="password-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                        <button
                            type="button"
                            class="show-password"
                            onclick="togglePassword()"
                            id="showBtn"
                        >
                            Lihat
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Masuk ke Hadirin <span>→</span>
                </button>
            </form>

            <div class="login-footer">
                <strong>✦</strong> Sistem absensi digital kampus<br>
                Akses akun hanya untuk pengguna terdaftar.
            </div>

        </div>

    </section>

</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const button = document.getElementById('showBtn');

        if (password.type === 'password') {
            password.type = 'text';
            button.textContent = 'Sembunyikan';
        } else {
            password.type = 'password';
            button.textContent = 'Lihat';
        }
    }
</script>

</body>
</html>
