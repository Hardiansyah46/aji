<?php
include "data/products.php";

$page = $_GET['page'] ?? 'home';
$id   = $_GET['id'] ?? null;
$hal  = $_GET['hal'] ?? 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>AfiliasiStore</title>

<!-- Fonts & Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
<script src="https://unpkg.com/feather-icons"></script>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="navbar-left">
    <div class="navbar-logo">AfiliasiStore</div>
  </div>

  <div class="navbar-right">
    <button class="search-toggle" id="searchToggle">
      <i data-feather="search"></i>
    </button>
    <button id="hamburger-menu">
      <i data-feather="menu"></i>
    </button>
  </div>

  <!-- Search form -->
  <form class="navbar-search" id="searchForm">
    <button type="button" id="searchClose" aria-label="Close search">&times;</button>
    <input type="text" id="desktopSearchInput" placeholder="Cari produk..." />
    <button type="submit"><i data-feather="search"></i></button>
  </form>



  <ul class="navbar-nav">
    <li><a href="index.php?page=home">Home</a></li>
    <li><a href="index.php?page=otomotif">Otomotif</a></li>
    <li><a href="index.php?page=fashion">Fashion</a></li>
    <li><a href="index.php?page=peralatanrumah">Peralatan Rumah</a></li>
    <li><a href="index.php?page=elektronik">Elektronik</a></li>
    <li><a href="#kontak">Kontak</a></li>
  </ul>
</nav>

<!-- Main Content -->
<main class="main-content">
  <?php
    switch($page) {
        case 'home':
            include "pages/home.php";
            break;
        case 'produk':
            include "pages/produk.php";
            break;
        case 'arsip':
            include "pages/arsip.php";
            break;
        case 'otomotif':
        case 'fashion':
        case 'peralatanrumah':
        case 'kecantikan':
            $_GET['cat'] = $page;
            include "pages/category.php";
            break;
        default:
            include "pages/home.php";
            break;
    }
  ?>
</main>

<!-- Kontak -->
<section id="kontak" class="contact">
  <h2><span>Kontak</span> Kami</h2>
  <p>Ingin bekerjasama sebagai affiliate? Hubungi kami!</p>
  <div class="row">
    <form id="contactForm">
      <div class="input-group">
        <i data-feather="user"></i>
        <input type="text" name="name" placeholder="Nama" required>
      </div>
      <div class="input-group">
        <i data-feather="mail"></i>
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <i data-feather="message-circle"></i>
        <textarea name="message" placeholder="Tulis pesan..." required></textarea>
      </div>
      <button type="submit" id="sendEmailBtn" class="btn">Kirim</button>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="modern-footer">
  <div class="footer-container">
    <div class="socials">
      <a href="#" class="social instagram" aria-label="Instagram"><i data-feather="instagram"></i></a>
      <a href="#" class="social twitter" aria-label="X"><i data-feather="x"></i></a>
      <a href="#" class="social facebook" aria-label="Facebook"><i data-feather="facebook"></i></a>
    </div>
    <div class="credit">
      <p>&copy; 2025 <span>YourBrand</span>. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="js/script.js?v=<?php echo time(); ?>" defer></script>
<script>feather.replace();</script>
</body>
</html>


