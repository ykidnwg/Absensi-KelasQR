<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hadirin — UI/UX Prototype</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  
  {{-- Pemanggilan CSS Utama --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- Perbaikan Z-Index, Pointer Events, dan Hidden --}}
  <style>
    /* Memastikan atribut hidden HTML bekerja mutlak */
    [hidden] {
      display: none !important;
    }
    
    /* Memastikan elemen background/orbit tidak menghalangi klik mouse */
    .landing-visual, .landing-orbit, .landing-glow {
      pointer-events: none !important;
    }
    
    /* Mengaktifkan kembali interaksi klik khusus untuk kartu di dalamnya */
    .landing-card {
      pointer-events: auto !important;
    }
    
    /* Memaksa tombol dan nav selalu berada di lapisan paling depan */
    .landing-nav, .landing-actions, button {
      position: relative !important;
      z-index: 9999 !important;
      pointer-events: auto !important;
      cursor: pointer !important;
    }
  </style>
</head>
<body>
  <main class="app-shell">
    <section class="landing-page" id="landingPage">
      <nav class="landing-nav">
        <div class="brand"><span class="brand-mark">H<span>.</span></span><span>hadirin</span></div>
        <span class="landing-status"><i></i> SISTEM ABSENSI DIGITAL</span>
        <button class="landing-login" id="openLoginTop">Masuk <span>↗</span></button>
      </nav>
      <div class="landing-hero">
        <div class="landing-copy">
          <p class="mini-label">YOUR CAMPUS, IN SYNC</p>
          <h1>Datang.<br>Scan.<br><span>Selesai.</span></h1>
          <p class="landing-description">Urusan kehadiran jadi lebih simpel. Pantau jadwal, catat absensi, dan tetap terhubung dengan kelasmu dalam satu ruang.</p>
          <div class="landing-actions">
            <button class="landing-cta" id="openLogin">Mulai sekarang <span>↗</span></button>
            <span class="landing-note"><i></i> Simpel, cepat, terhubung.</span>
          </div>
          <div class="landing-proof">
            <div class="proof-avatars"><span>YN</span><span>TI</span><span>✦</span></div>
            <p>Dibuat untuk aktivitas kampus<br><strong>yang lebih praktis.</strong></p>
          </div>
        </div>
        <div class="landing-visual">
          <div class="landing-orbit orbit-a"></div>
          <div class="landing-orbit orbit-b"></div>
          <div class="landing-glow"></div>
          <div class="landing-card">
            <div class="landing-card-head">
              <div><span class="tiny-label">SELAMAT DATANG,</span><strong>Yuli Nur Anggraeni ✦</strong></div>
              <span class="avatar">YN</span>
            </div>
            <div class="landing-attendance">
              <div><span class="tiny-label">KEHADIRAN SEMESTER INI</span><strong>92<span>%</span></strong><small>Performa kehadiranmu</small></div>
              <div class="landing-ring"><span>92%</span></div>
            </div>
            <div class="landing-mini-grid">
              <div><span class="tiny-label">HADIR</span><strong>24</strong></div>
              <div><span class="tiny-label">IZIN</span><strong>02</strong></div>