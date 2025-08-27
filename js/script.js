document.addEventListener("DOMContentLoaded", function () {
  const searchToggle = document.getElementById("searchToggle");
  const searchForm = document.getElementById("searchForm");
  const hamburgerMenu = document.getElementById("hamburger-menu");
  const navbarNav = document.querySelector(".navbar-nav");
  const searchClose = document.getElementById("searchClose");
  const input = document.getElementById("desktopSearchInput");
  const searchResults = document.getElementById("searchResults");

  // Ambil semua menu-card (kalau mau dipakai untuk filter lokal)
  const articles = Array.from(document.querySelectorAll(".menu-card")).map(
    (card) => {
      return {
        element: card,
        title: card.querySelector("h3").textContent.toLowerCase(),
        excerpt: card.querySelector("p")?.textContent.toLowerCase() || "",
      };
    }
  );

  // Submit search (fetch ke search.php biar global)
  searchForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    const keyword = input.value.trim();

    if (!keyword) return;

    fetch(`/AffiliasisStore/pages/search.php?q=${encodeURIComponent(keyword)}`)
      .then((res) => res.json())
      .then((data) => {
        let html = "";
        if (data.length === 0) {
          html = `<p>Tidak ada hasil ditemukan untuk "<strong>${keyword}</strong>"</p>`;
        } else {
          html = data
            .map(
              (item) => `
                <div class="menu-card">
                  <img src="${item.img}" alt="${item.title}" class="featured-img">
                  <div class="card-content">
                    <h3>${item.title}</h3>
                    <p class="excerpt">${item.desc}</p>
                    <a href="index.php?page=produk&id=${item.id}" class="read-more">Lihat Produk</a>
                  </div>
                </div>
              `
            )
            .join("");
        }
        searchResults.innerHTML = html;
      })
      .catch((err) => {
        console.error(err);
        searchResults.innerHTML = "<p>Terjadi kesalahan.</p>";
      });
  });

  // Toggle search (mobile)
  searchToggle?.addEventListener("click", () => {
    searchForm.classList.toggle("active");
    if (searchForm.classList.contains("active")) {
      navbarNav.classList.remove("active");
      input.focus();
    }
  });

  // Tombol X (reset input)
  searchClose?.addEventListener("click", () => {
    input.value = "";
    searchClose.style.display = "none";
    input.focus();
  });

  // Munculkan tombol X kalau ada input
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

  // Klik luar → tutup menu & search
  document.addEventListener("click", function (e) {
    const target = e.target;

    if (
      (!hamburgerMenu || !hamburgerMenu.contains(target)) &&
      (!navbarNav || !navbarNav.contains(target)) &&
      (!searchToggle || !searchToggle.contains(target)) &&
      (!searchForm || !searchForm.contains(target))
    ) {
      navbarNav?.classList.remove("active");
      searchForm?.classList.remove("active");
      if (searchClose) searchClose.style.display = "none";
    }
  });

  // Tombol "Kontak kami"
  document
    .getElementById("sendEmailBtn")
    ?.addEventListener("click", function (e) {
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
