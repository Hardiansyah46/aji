<?php
include __DIR__ . "/../data/products.php";

// Sidebar 3 produk terbaru
$sidebar_items = array_slice(array_reverse($products), 0, 3);

// Pagination
$perPage = 6;
$pageNum = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $perPage);

// Produk untuk halaman saat ini
$start = ($pageNum - 1) * $perPage;
$display_products = array_slice(array_reverse($products), $start, $perPage);
?>

<div class="layout">
  <main class="main">
    <h2>Produk Pilihan</h2>

    <div id="searchResults"></div>

    <div class="row">
      <?php if(!empty($display_products)): ?>
        <?php foreach($display_products as $p): ?>
          <div class="menu-card">
            <img src="<?= $baseURL ?>/<?= $p['img'] ?? '' ?>" alt="<?= $p['nama'] ?? 'Produk' ?>" class="featured-img">
            <div class="card-content">
              <h3><?= $p['nama'] ?? 'Judul Produk' ?></h3>
              <p class="excerpt"><?= $p['desc'] ?? '-' ?></p>
              <!-- Link produk SEO-friendly -->
              <a href="<?= $baseURL ?>/<?= $p['kategori'] ?>/<?= $p['slug'] ?? '#' ?>" class="read-more">Lihat Produk</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Tidak ada produk tersedia.</p>
      <?php endif; ?>
    </div>

    <!-- Pagination SEO-friendly -->
    <?php if($totalPages > 1): ?>
      <div class="pagination">
        <?php for($i=1; $i<=$totalPages; $i++): ?>
          <a href="<?= $baseURL ?>/page/<?= $i ?>" class="<?= $i==$pageNum ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </main>

  <aside class="sidebar">
    <h3>Produk Terbaru</h3>
    <ul>
      <?php foreach($sidebar_items as $item): ?>
        <!-- Link produk terbaru SEO-friendly -->
        <li><a href="<?= $baseURL ?>/<?= $item['kategori'] ?>/<?= $item['slug'] ?>"><?= $item['nama'] ?></a></li>
      <?php endforeach; ?>
    </ul>

    
  </aside>
</div>
