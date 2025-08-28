<?php
include __DIR__ . "/../data/products.php";

$kategori = $_GET['kategori'] ?? null;
$slug = $_GET['slug'] ?? null;

$product = null;
foreach ($products as $p) {
    if (strtolower($p['slug']) === strtolower($slug) && strtolower($p['kategori']) === strtolower($kategori)) {
        $product = $p;
        break;
    }
}

if (!$product) {
    echo "<h2>Produk tidak ditemukan!</h2>";
    exit;
}


// Sidebar 3 produk terbaru
$sidebar_items = array_slice(array_reverse($products), 0, 7);
?>

<div class="layout">
  <main class="main" style="flex:1; min-width:300px;">
    <div class="produk-detail">
      <div class="main-wrapper">
        <div class="produk-container">
          <div class="produk-info">
            <div class="produk-img">
              <img src="<?= $baseURL ?>/<?= $p['img'] ?? '' ?>" alt="<?= $p['nama'] ?? 'Produk' ?>" class="featured-img">
            </div>
            <h2><?= $product['nama'] ?></h2>
            <p class="produk-desc"><?= $product['full_desc'] ?? $product['desc'] ?></p>
            <p>Harga: <?= isset($product['price']) ? 'Rp ' . number_format($product['price'],0,",",".") : '-' ?></p>

            <a href="<?= $product['link_affiliate'] ?>" class="btn-beli" target="_blank">Beli Sekarang</a>
            <a href="<?= $baseURL ?>/<?= $kategori ?>" class="btn-back">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <aside class="sidebar">
    <h3>Produk Terbaru</h3>
    <ul>
      <?php foreach($sidebar_items as $item): ?>
        <li><a href="<?= $baseURL ?>/<?= $item['kategori'] ?>/<?= $item['slug'] ?>"><?= $item['nama'] ?></a></li>
      <?php endforeach; ?>
    </ul>
  </aside>
</div>
