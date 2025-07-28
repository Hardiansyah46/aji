const searchToggle = document.getElementById("searchToggle");
const searchForm = document.getElementById("searchForm");
const hamburgerMenu = document.getElementById("hamburger-menu");
const navbarNav = document.querySelector(".navbar-nav");
const searchClose = document.getElementById("searchClose");
const input = searchForm.querySelector("input[type='text']");

// Toggle search form (mobile)
searchToggle.addEventListener("click", () => {
  searchForm.classList.toggle("active");
  if (searchForm.classList.contains("active")) {
    navbarNav.classList.remove("active");
    input.focus();
  }
});

// Tombol X: kosongkan input, sembunyikan tombol X, tapi form tetap aktif
searchClose.addEventListener("click", () => {
  input.value = "";
  searchClose.style.display = "none";
  input.focus();
});

// Tampilkan/ Sembunyikan tombol X sesuai isi input
input.addEventListener("input", () => {
  if (input.value.trim() !== "") {
    searchClose.style.display = "inline";
  } else {
    searchClose.style.display = "none";
  }
});

// Toggle hamburger menu
hamburgerMenu.addEventListener("click", () => {
  navbarNav.classList.toggle("active");
  if (navbarNav.classList.contains("active")) {
    searchForm.classList.remove("active");
  }
});

// Klik di luar untuk menutup nav menu dan search form
document.addEventListener("click", function (e) {
  const target = e.target;

  if (
    !hamburgerMenu.contains(target) &&
    !navbarNav.contains(target) &&
    !searchToggle.contains(target) &&
    !searchForm.contains(target)
  ) {
    navbarNav.classList.remove("active");
    searchForm.classList.remove("active");
    searchClose.style.display = "none"; // juga sembunyikan tombol X saat form tutup
  }
});

// Untuk kontak form whatsaap
document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = this.name.value.trim();
  const email = this.email.value.trim();
  const message = this.message.value.trim();

  const phoneNumber = "62XXXXXXXXXX"; // Ganti dengan nomor WhatsApp kamu

  const whatsappMessage = `Halo, saya ${name} (%0AEmail: ${email}) ingin menghubungi kamu.%0A%0A${message}`;

  const url = `https://wa.me/${phoneNumber}?text=${whatsappMessage}`;

  window.open(url, "_blank"); // buka di tab baru
});
