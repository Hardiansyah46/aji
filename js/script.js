document.addEventListener("DOMContentLoaded", function () {
  const searchToggle = document.getElementById("searchToggle");
  const searchForm = document.getElementById("searchForm");
  const hamburgerMenu = document.getElementById("hamburger-menu");
  const navbarNav = document.querySelector(".navbar-nav");
  const searchClose = document.getElementById("searchClose");
  const input = document.getElementById("desktopSearchInput");
  const searchResults = document.getElementById("searchResults");

  // Ambil semua menu-card
  const articles = Array.from(document.querySelectorAll(".menu-card")).map(
    (card) => {
      return {
        element: card,
        title: card.querySelector("h3").textContent.toLowerCase(),
        excerpt: card.querySelector("p")?.textContent.toLowerCase() || "",
      };
    }
  );

  // Submit search
  searchForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    const keyword = input.value.trim().toLowerCase();
    let matchCount = 0;

    articles.forEach((item) => (item.element.style.display = "none"));

    articles.forEach((item) => {
      if (item.title.includes(keyword) || item.excerpt.includes(keyword)) {
        item.element.style.display = "";
        matchCount++;
      }
    });

    searchResults.innerHTML =
      matchCount === 0
        ? `<p>Tidak ada hasil ditemukan untuk "<strong>${keyword}</strong>"</p>`
        : "";
  });

  // Toggle search (mobile)
  searchToggle?.addEventListener("click", () => {
    searchForm.classList.toggle("active");
    if (searchForm.classList.contains("active")) {
      navbarNav.classList.remove("active");
      input.focus();
    }
  });

  // Tombol X
  searchClose?.addEventListener("click", () => {
    input.value = "";
    searchClose.style.display = "none";
    input.focus();
  });

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

  // Klik luar tutup
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
  document
    .getElementById("sendEmailBtn")
    .addEventListener("click", function (e) {
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
});
