
const loginPage = document.getElementById("loginPage");
const dashboardPage = document.getElementById("dashboardPage");
const loginForm = document.getElementById("loginForm");
const toast = document.getElementById("toast");

function showToast(message) {
  if (!toast) return;

  toast.textContent = message;
  toast.classList.add("show");

  window.clearTimeout(showToast.timer);
  showToast.timer = window.setTimeout(() => {
    toast.classList.remove("show");
  }, 2800);
}

// Tampilkan atau sembunyikan password
document.getElementById("togglePassword")?.addEventListener("click", () => {
  const password = document.getElementById("password");
  const visible = password.type === "text";

  password.type = visible ? "password" : "text";
  document.getElementById("togglePassword").textContent =
    visible ? "Lihat" : "Sembunyikan";
});

// Simulasi login
loginForm?.addEventListener("submit", (event) => {
  event.preventDefault();

  loginPage.hidden = true;

  const visualPanel = document.querySelector(".visual-panel");
  if (visualPanel) visualPanel.hidden = true;

  dashboardPage.hidden = false;

  window.scrollTo({ top: 0, behavior: "smooth" });
  showToast("Berhasil masuk ke prototipe Hadirin. Ini hanya simulasi UI.");
});

// Logout
document.getElementById("logoutBtn")?.addEventListener("click", () => {
  dashboardPage.hidden = true;
  loginPage.hidden = false;

  const visualPanel = document.querySelector(".visual-panel");
  if (visualPanel) visualPanel.hidden = false;

  loginForm?.reset();

  window.scrollTo({ top: 0, behavior: "smooth" });
  showToast("Kamu sudah keluar dari prototipe.");
});

// Navigasi dashboard
document.querySelectorAll("[data-view]").forEach((button) => {
  button.addEventListener("click", () => {
    const view = button.dataset.view;

    const labels = {
      overview: ["Ringkasan", "aktivitas."],
      attendance: ["Riwayat", "kehadiran."],
      schedule: ["Jadwal", "kuliah."],
      profile: ["Profil", "saya."]
    };

    if (!labels[view]) return;

    document.querySelectorAll(".nav-item").forEach((item) => {
      item.classList.toggle("active", item.dataset.view === view);
    });

    const title = document.getElementById("pageTitle");

    if (title) {
      title.innerHTML = `${labels[view][0]} <span>${labels[view][1]}</span>`;
    }

    if (view === "overview") {
      showToast("Menampilkan ringkasan aktivitas.");
    } else {
      showToast(
        `Tampilan ${labels[view][0]} ${labels[view][1]} masih berupa prototipe UI.`
      );
    }
  });
});

// Tombol scan QR
document.getElementById("scanBtn")?.addEventListener("click", () => {
  showToast("Fitur scan QR belum terhubung. Ini baru prototipe UI/UX.");
});

// Bantuan kata sandi
document.getElementById("forgotLink")?.addEventListener("click", (event) => {
  event.preventDefault();
  showToast("Hubungi admin kampus untuk bantuan kata sandi.");
});

