const searchToggle = document.getElementById("searchToggle");
const searchForm = document.getElementById("searchForm");
const hamburgerMenu = document.getElementById("hamburger-menu");
const navbarNav = document.querySelector(".navbar-nav");
const searchClose = document.getElementById("searchClose");
const input = searchForm.querySelector("input[type='text']");
const desktopSearchInput = document.getElementById("desktopSearchInput");
const searchResults = document.getElementById("searchResults");

// Ambil semua artikel
const articles = Array.from(document.querySelectorAll(".menu-card")).map(
  (card) => {
    return {
      element: card,
      title: card.querySelector("h3").textContent.toLowerCase(),
      excerpt: card.querySelector("p")?.textContent.toLowerCase() || "",
    };
  }
);

// Saat form dikirim
searchForm?.addEventListener("submit", function (e) {
  e.preventDefault();
  const keyword = desktopSearchInput.value.trim().toLowerCase();
  let matchCount = 0;

  // Sembunyikan semua artikel
  articles.forEach((item) => {
    item.element.style.display = "none";
  });

  // Tampilkan artikel yang cocok
  articles.forEach((item) => {
    if (item.title.includes(keyword) || item.excerpt.includes(keyword)) {
      item.element.style.display = "block";
      matchCount++;
    }
  });

  // Jika tidak ditemukan
  searchResults.innerHTML =
    matchCount === 0
      ? `<p>Tidak ada hasil ditemukan untuk "<strong>${keyword}</strong>"</p>`
      : "";
});

// Toggle search form (mobile)
searchToggle?.addEventListener("click", () => {
  searchForm.classList.toggle("active");
  if (searchForm.classList.contains("active")) {
    navbarNav?.classList.remove("active");
    input.focus();
  }
});

// Tombol X: kosongkan input, sembunyikan tombol X, tetap aktif
searchClose?.addEventListener("click", () => {
  input.value = "";
  searchClose.style.display = "none";
  input.focus();
});

// Tampilkan tombol X sesuai input
input?.addEventListener("input", () => {
  searchClose.style.display = input.value.trim() !== "" ? "inline" : "none";
});

// Toggle hamburger menu
hamburgerMenu?.addEventListener("click", () => {
  navbarNav.classList.toggle("active");
  if (navbarNav.classList.contains("active")) {
    searchForm.classList.remove("active");
  }
});

// Klik luar = tutup menu & form pencarian
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
    searchClose.style.display = "none";
  }
});

// Kontak kami
document.getElementById("sendEmailBtn").addEventListener("click", function (e) {
  e.preventDefault();

  const name = document.querySelector("input[name='name']").value;
  const email = document.querySelector("input[name='email']").value;
  const message = document.querySelector("textarea[name='message']").value;

  const subject = encodeURIComponent("Permintaan Kerjasama Affiliate");
  const body = encodeURIComponent(
    `Nama: ${name}\nEmail: ${email}\nPesan: ${message}`
  );

  window.location.href = `mailto:ajihardinasah123@gmail.com?subject=${subject}&body=${body}`;
});

feather.replace(); // Penting agar ikon muncul
