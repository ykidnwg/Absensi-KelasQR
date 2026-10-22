# Hadirin — UI/UX Prototype

Prototype antarmuka aplikasi Hadirin, yaitu sistem absensi kelas berbasis QR untuk kebutuhan perkuliahan.

## Teknologi

- HTML5 untuk struktur halaman.
- CSS3 untuk tampilan dan desain responsif.
- JavaScript untuk interaksi antarmuka.

## Fitur Prototype

- Halaman login mahasiswa.
- Dashboard mahasiswa.
- Ringkasan statistik kehadiran.
- Tampilan riwayat absensi.
- Tampilan jadwal kuliah.
- Tampilan profil mahasiswa.
- Tombol simulasi scan QR.
- Interaksi navigasi dan logout.

## Struktur File

```text
temp-repo/
├── index.html
├── style.css
├── script.js
└── README.md
```

## Cara Menjalankan

1. Unduh atau clone repository.
2. Buka folder proyek.
3. Buka file `index.html` menggunakan browser.
4. Coba interaksi login dan menu dashboard.

## Catatan Integrasi Laravel

Prototype ini belum terhubung dengan database maupun autentikasi Laravel. Data yang ditampilkan merupakan data contoh.

Rencana integrasi:

- `index.html` disesuaikan menjadi Blade, misalnya `resources/views/auth/login.blade.php`.
- `style.css` dapat ditempatkan di `public/css/style.css`.
- `script.js` dapat ditempatkan di `public/js/script.js`.
- Proses autentikasi, pengambilan data absensi, dan otorisasi pengguna ditangani oleh backend Laravel.

Lokasi akhir file harus disesuaikan dengan struktur proyek Laravel kelompok.

## Branch Pengembangan

UI/UX dikerjakan pada branch `feature/ui-alifia`.

Perubahan prototype dikirim ke branch tersebut agar tidak langsung mengubah branch utama proyek kelompok.