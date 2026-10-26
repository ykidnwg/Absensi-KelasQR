document.addEventListener("DOMContentLoaded", () => {
  const landingPage = document.getElementById("landingPage");
  const loginPage = document.getElementById("loginPage");
  const dashboardPage = document.getElementById("dashboardPage");
  const loginForm = document.getElementById("loginForm");
  const toast = document.getElementById("toast");
  const visualPanel = document.querySelector(".visual-panel");
  const originalDashboard = dashboardPage ? dashboardPage.innerHTML : "";

  function showToast(message) {
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add("show");
    window.clearTimeout(showToast.timer);
    showToast.timer = window.setTimeout(() => toast.classList.remove("show"), 2800);
  }

  function safeText(value) {
    return String(value).replace(/[&<>"']/g, char => ({
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#39;"
    }[char]));
  }

  function adminDashboard(name) {
    return `
    <aside class="sidebar"><div class="brand sidebar-brand"><span class="brand-mark">H<span>.</span></span><span>hadirin</span></div><p class="nav-caption">MENU ADMIN</p>
      <button class="nav-item active" data-view="overview"><span>▦</span> Ringkasan</button><button class="nav-item" data-view="mahasiswa"><span>♙</span> Data Mahasiswa</button><button class="nav-item" data-view="dosen"><span>♧</span> Data Dosen</button><button class="nav-item" data-view="kelas"><span>▣</span> Data Kelas</button><button class="nav-item" data-view="sesi"><span>◷</span> Sesi Absensi</button>
      <div class="sidebar-bottom"><div class="help-card"><span class="help-icon">✦</span><strong>Pusat bantuan</strong><p>Kelola data kampus dalam satu tempat.</p></div><button class="logout-btn" id="logoutBtn"><span>↪</span> Keluar</button></div></aside>
    <section class="dashboard-main"><header class="dash-header"><div><p class="mini-label">PANEL PENGELOLAAN KAMPUS</p><h2 id="pageTitle">Ringkasan <span>admin.</span></h2></div><div class="header-actions"><button class="icon-btn" aria-label="Notifikasi">♧<i></i></button><div class="user-chip"><div class="avatar">AD</div><div><strong>${safeText(name)}</strong><small>Admin</small></div></div></div></header>
    <div class="welcome-banner"><div><span class="banner-label">PANEL ADMIN HADIRIN</span><h3>Semua data, lebih teratur.</h3><p>Pantau pengguna dan aktivitas absensi kampus.</p></div><div class="banner-art">H<span>.</span></div></div>
    <div class="section-heading"><div><h3>Ringkasan sistem</h3><p>Data contoh untuk demonstrasi UI</p></div><span class="semester-pill">Tahun akademik 2026/2027</span></div>
    <div class="stats-grid"><article class="stat-card"><div class="stat-top"><span>Total mahasiswa</span><span class="stat-icon">♙</span></div><strong>248</strong><small>akun terdaftar</small></article><article class="stat-card pink-stat"><div class="stat-top"><span>Total dosen</span><span class="stat-icon">♧</span></div><strong>18</strong><small>akun pengajar</small></article><article class="stat-card"><div class="stat-top"><span>Kelas aktif</span><span class="stat-icon">▣</span></div><strong>12</strong><small>kelas semester ini</small></article><article class="stat-card"><div class="stat-top"><span>Sesi hari ini</span><span class="stat-icon">◷</span></div><strong>08</strong><small class="good-text">Absensi berjalan</small></article></div>
    <div class="content-grid"><article class="content-card"><div class="card-heading"><div><h3>Aktivitas terbaru</h3><p>Contoh aktivitas sistem</p></div><button class="text-btn" data-view="sesi">Lihat sesi ↗</button></div><div class="table-wrap"><table><thead><tr><th>AKTIVITAS</th><th>PENGGUNA</th><th>WAKTU</th><th>STATUS</th></tr></thead><tbody><tr><td><strong>Absensi kelas dibuat</strong><small>Interaksi Manusia & Komputer</small></td><td>Dr. Maya</td><td>08.00</td><td><span class="badge present">Aktif</span></td></tr><tr><td><strong>Mahasiswa ditambahkan</strong><small>Data mahasiswa baru</small></td><td>Admin</td><td>07.45</td><td><span class="badge present">Selesai</span></td></tr><tr><td><strong>Rekap kehadiran</strong><small>Basis Data · TI-4A</small></td><td>Dr. Raka</td><td>Kemarin</td><td><span class="badge permission">Ditinjau</span></td></tr></tbody></table></div></article><article class="content-card quick-card"><div class="card-heading"><div><h3>Akses cepat</h3><p>Kelola sistem</p></div></div><button class="quick-action" data-view="mahasiswa"><span class="quick-icon">♙</span><span><strong>Data mahasiswa</strong><small>Lihat daftar mahasiswa</small></span><b>↗</b></button><button class="quick-action" data-view="dosen"><span class="quick-icon">♧</span><span><strong>Data dosen</strong><small>Lihat daftar pengajar</small></span><b>↗</b></button><button class="quick-action" data-view="kelas"><span class="quick-icon">▣</span><span><strong>Data kelas</strong><small>Kelola kelas kuliah</small></span><b>↗</b></button></article></div><footer class="dash-footer">Hadirin · Panel Admin <span>Prototipe UI/UX — data hanya contoh.</span></footer></section>`;
  }

  function dosenDashboard(name) {
    return `
    <aside class="sidebar"><div class="brand sidebar-brand"><span class="brand-mark">H<span>.</span></span><span>hadirin</span></div><p class="nav-caption">MENU DOSEN</p>
      <button class="nav-item active" data-view="overview"><span>▦</span> Ringkasan</button><button class="nav-item" data-view="kelas"><span>▣</span> Kelas Saya</button><button class="nav-item" data-view="attendance"><span>◷</span> Rekap Absensi</button><button class="nav-item" data-view="sesi"><span>▦</span> Sesi QR</button><button class="nav-item" data-view="profile"><span>◎</span> Profil Saya</button>
      <div class="sidebar-bottom"><div class="help-card"><span class="help-icon">✦</span><strong>Butuh bantuan?</strong><p>Hubungi admin jika ada kendala sistem.</p></div><button class="logout-btn" id="logoutBtn"><span>↪</span> Keluar</button></div></aside>
    <section class="dashboard-main"><header class="dash-header"><div><p class="mini-label">RUANG KERJA PENGAJAR</p><h2 id="pageTitle">Ringkasan <span>kelas.</span></h2></div><div class="header-actions"><button class="icon-btn" aria-label="Notifikasi">♧<i></i></button><div class="user-chip"><div class="avatar">DS</div><div><strong>${safeText(name)}</strong><small>Dosen</small></div></div></div></header>
    <div class="welcome-banner"><div><span class="banner-label">SELAMAT DATANG, DOSEN</span><h3>Pantau kelasmu hari ini.</h3><p>Kelola sesi dan lihat kehadiran mahasiswa dengan mudah.</p></div><div class="banner-art">H<span>.</span></div></div>
    <div class="section-heading"><div><h3>Aktivitas mengajar</h3><p>Ringkasan data semester berjalan</p></div><span class="semester-pill">Semester Ganjil 2026/2027</span></div>
    <div class="stats-grid"><article class="stat-card"><div class="stat-top"><span>Kelas diampu</span><span class="stat-icon">▣</span></div><strong>04</strong><small>kelas aktif</small></article><article class="stat-card pink-stat"><div class="stat-top"><span>Mahasiswa</span><span class="stat-icon">♙</span></div><strong>126</strong><small>di seluruh kelas</small></article><article class="stat-card"><div class="stat-top"><span>Sesi berjalan</span><span class="stat-icon">◷</span></div><strong>02</strong><small>sesi aktif hari ini</small></article><article class="stat-card"><div class="stat-top"><span>Rata-rata hadir</span><span class="stat-icon">↗</span></div><strong>91<span class="percent">%</span></strong><small class="good-text">Data contoh semester ini</small></article></div>
    <div class="content-grid"><article class="content-card"><div class="card-heading"><div><h3>Kelas yang diampu</h3><p>Pilih kelas untuk melihat rekap</p></div><button class="text-btn" data-view="kelas">Lihat semua ↗</button></div><div class="table-wrap"><table><thead><tr><th>MATA KULIAH</th><th>KELAS</th><th>MAHASISWA</th><th>KEHADIRAN</th></tr></thead><tbody><tr><td><strong>Interaksi Manusia & Komputer</strong><small>Senin · 08.00</small></td><td>TI-4A</td><td>32</td><td><span class="badge present">94%</span></td></tr><tr><td><strong>Basis Data</strong><small>Selasa · 10.00</small></td><td>TI-4B</td><td>30</td><td><span class="badge present">90%</span></td></tr><tr><td><strong>Pemrograman Web</strong><small>Rabu · 13.00</small></td><td>TI-3A</td><td>34</td><td><span class="badge permission">88%</span></td></tr></tbody></table></div></article><article class="content-card quick-card"><div class="card-heading"><div><h3>Akses cepat</h3><p>Aktivitas pengajar</p></div></div><button class="quick-action" data-view="sesi"><span class="quick-icon">▦</span><span><strong>Buat sesi QR</strong><small>Simulasi sesi absensi baru</small></span><b>↗</b></button><button class="quick-action" data-view="attendance"><span class="quick-icon">◷</span><span><strong>Rekap absensi</strong><small>Pantau status mahasiswa</small></span><b>↗</b></button><div class="tip-card"><span>CATATAN</span><p>Pastikan sesi absensi sesuai jadwal perkuliahan.</p></div></article></div><footer class="dash-footer">Hadirin · Panel Dosen <span>Prototipe UI/UX — data hanya contoh.</span></footer></section>`;
  }

  const roleViews = {
    admin: {
      mahasiswa: ["Data", "mahasiswa."], dosen: ["Data", "dosen."], kelas: ["Data", "kelas."], sesi: ["Sesi", "absensi."], overview: ["Ringkasan", "admin."]
    },
    dosen: {
      kelas: ["Kelas", "saya."], attendance: ["Rekap", "absensi."], sesi: ["Sesi", "QR."], profile: ["Profil", "saya."], overview: ["Ringkasan", "kelas."]
    },
    mahasiswa: { overview: ["Ringkasan", "aktivitas."], attendance: ["Riwayat", "kehadiran."], schedule: ["Jadwal", "kuliah."], profile: ["Profil", "saya."] }
  };

  function bindDashboard(role) {
    if (!dashboardPage) return;
    dashboardPage.querySelectorAll("[data-view]").forEach(button => {
      button.addEventListener("click", () => {
        const view = button.dataset.view;
        const labels = roleViews[role] || roleViews.mahasiswa;
        if (!labels[view]) { showToast("Bagian ini masih berupa simulasi UI."); return; }
        dashboardPage.querySelectorAll(".nav-item").forEach(item => item.classList.toggle("active", item.dataset.view === view));
        const title = dashboardPage.querySelector("#pageTitle");
        if (title) title.innerHTML = `${labels[view][0]} <span>${labels[view][1]}</span>`;
        if (role === "mahasiswa" && view === "overview") showToast("Menampilkan ringkasan aktivitas.");
        else showToast(`Tampilan ${labels[view].join(" ")} masih berupa prototipe UI.`);
      });
    });
    dashboardPage.querySelector("#logoutBtn")?.addEventListener("click", logout);
    dashboardPage.querySelector("#scanBtn")?.addEventListener("click", () => showToast("Fitur scan QR belum terhubung. Ini baru prototipe UI/UX."));
  }

  function logout() {
    if (dashboardPage) dashboardPage.hidden = true;
    if (loginPage) loginPage.hidden = true;
    if (landingPage) landingPage.hidden = false;
    if (visualPanel) visualPanel.hidden = true;
    if (dashboardPage) dashboardPage.innerHTML = originalDashboard;
    loginForm?.reset();
    window.scrollTo({ top: 0, behavior: "smooth" });
    showToast("Kamu sudah keluar dari prototipe.");
  }

  function openLoginPage() {
    if (landingPage) landingPage.hidden = true;
    if (loginPage) loginPage.hidden = false;
    if (visualPanel) visualPanel.hidden = true;
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  document.getElementById("openLogin")?.addEventListener("click", openLoginPage);
  document.getElementById("openLoginTop")?.addEventListener("click", openLoginPage);
  document.getElementById("backLanding")?.addEventListener("click", () => {
    if (loginPage) loginPage.hidden = true;
    if (landingPage) landingPage.hidden = false;
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  document.getElementById("togglePassword")?.addEventListener("click", () => {
    const password = document.getElementById("password");
    if (!password) return;
    const visible = password.type === "text";
    password.type = visible ? "password" : "text";
    const toggleBtn = document.getElementById("togglePassword");
    if (toggleBtn) toggleBtn.textContent = visible ? "Lihat" : "Sembunyikan";
  });

  loginForm?.addEventListener("submit", event => {
    event.preventDefault();
    const role = document.getElementById("role")?.value || "mahasiswa";
    const email = document.getElementById("email")?.value || "";
    const name = email.includes("@") ? email.split("@")[0].replace(/[._-]+/g, " ").replace(/\b\w/g, char => char.toUpperCase()) : "Pengguna Hadirin";
    if (loginPage) loginPage.hidden = true;
    if (landingPage) landingPage.hidden = true;
    if (visualPanel) visualPanel.hidden = true;
    if (dashboardPage) {
      dashboardPage.innerHTML = role === "admin" ? adminDashboard(name) : role === "dosen" ? dosenDashboard(name) : originalDashboard;
      dashboardPage.hidden = false;
    }
    if (role === "mahasiswa" && dashboardPage) {
      const nameStrong = dashboardPage.querySelector(".user-chip strong");
      if (nameStrong) nameStrong.textContent = name || "Alifia Sandra";
    }
    bindDashboard(role);
    window.scrollTo({ top: 0, behavior: "smooth" });
    showToast(`Berhasil masuk ke dashboard ${role}. Ini hanya simulasi UI.`);
  });

  document.getElementById("forgotLink")?.addEventListener("click", event => {
    event.preventDefault();
    showToast("Hubungi admin kampus untuk bantuan kata sandi.");
  });

  // Jalankan bind jika dashboardPage ada
  if (dashboardPage) {
    bindDashboard("mahasiswa");
  }
});