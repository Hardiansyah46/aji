// Toggle menu
const hamburger = document.querySelector("#hamburger-menu");
const navMenu = document.querySelector(".navbar-nav");

hamburger.addEventListener("click", function (e) {
  e.preventDefault();
  navMenu.classList.toggle("active");
});

// Klik di luar untuk menutup nav
document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
    navMenu.classList.remove("active");
  }
});
