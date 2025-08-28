<?php
$baseURL = '/Store';
include __DIR__ . "/data/products.php";

$page     = $_GET['page'] ?? 'home';
$slug     = $_GET['slug'] ?? null;
$cat      = $_GET['cat'] ?? null;
$hal      = $_GET['hal'] ?? 1;
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
<link rel="stylesheet" href="<?= $baseURL ?>/css/style.css?v=<?= time() ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
<script src="https://unpkg.com/feather-icons"></script>
<link rel="icon" href="<?= $baseURL ?>/favicon.ico" type="image/x-icon">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="navbar-left">
    <div class="navbar-logo"><a>AfiliasiStore</a></div>
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
  <form class="navbar-search" id="searchForm" action="<?= $baseURL ?>/search" method="get">
  <button type="button" id="searchClose" aria-label="Close search">
    <i data-feather="x"></i>
  </button>
  <input type="text" id="desktopSearchInput" name="q" 
         placeholder="Cari produk..." 
         value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" />
  <button type="submit"><i data-feather="search"></i></button>
</form>


  <ul class="navbar-nav">
    <li><a href="<?= $baseURL ?>/">Home</a></li>
    <?php
    // Ambil daftar kategori unik dari products
    $categories = [];
    foreach($products as $p) {
        if(!in_array($p['kategori'], $categories)) $categories[] = $p['kategori'];
    }
    foreach($categories as $catNav): ?>
      <li><a href="<?= $baseURL ?>/<?= $catNav ?>"><?= ucfirst($catNav) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?= $baseURL ?>/?page=about">Tentang Kami</a></li>
  </ul>
</nav>

<!-- Main Content -->
<main class="main-content">
<?php
switch($page) {
    case 'produk':
        if ($slug && isset($_GET['kategori'])) {
            include __DIR__ . "/pages/produk.php";
        } else {
            include __DIR__ . "/pages/home.php";
        }
        break;

    case 'category':
        if ($cat) {
            include __DIR__ . "/pages/category.php";
        } else {
            include __DIR__ . "/pages/home.php";
        }
        break;

    case 'search': 
        include __DIR__ . "/pages/search.php";
        break;

    case 'home':
    default:
        include __DIR__ . "/pages/home.php";
        break;

        case 'about':
    include __DIR__ . "/pages/aboutus.php";
    break;

}
?>
</main>


<!-- Footer -->
<footer class="modern-footer">
  <div class="footer-container">
    <!-- Sosial Media -->
    <div class="socials">
      <a href="#" class="social instagram" aria-label="Instagram"><i data-feather="instagram"></i></a>
      <a href="#" class="social twitter" aria-label="X"><i data-feather="x"></i></a>
      <a href="#" class="social facebook" aria-label="Facebook"><i data-feather="facebook"></i></a>
    </div>

    <!-- Links -->
    <div class="footer-links">
      <a href="<?= $baseURL ?>/?page=about">Tentang Kami</a>
    </div>

    <!-- Credit -->
    <div class="credit">
      <p>&copy; 2025 <span>AfiliasiStore</span>. All rights reserved.</p>
    </div>
  </div>
</footer>


<script src="<?= $baseURL ?>/js/script.js?v=<?= time() ?>" defer></script>
<script>feather.replace();</script>
</body>
</html>
