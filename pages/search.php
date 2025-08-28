<?php
include __DIR__ . "/../data/products.php";

$q = trim($_GET['q'] ?? '');
$results = [];

if ($q !== '') {
    $results = array_filter($products, function($p) use ($q) {
        return stripos($p['nama'], $q) !== false
            || stripos($p['desc'], $q) !== false
            || stripos($p['full_desc'] ?? '', $q) !== false
            || stripos($p['kategori'] ?? '', $q) !== false;
    });
}

// Kalau request dari AJAX → balikan JSON
if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
) {
    header('Content-Type: application/json');
    echo json_encode(array_values($results));
    exit;
}
?>

<div class="layout">
  <main class="main">
    <h2>Hasil Pencarian: "<?= htmlspecialchars($q) ?>"</h2>

    <div id="searchResults">
      <?php if (!empty($results)): ?>
        <div class="row">
          <?php foreach ($results as $p): ?>
            <div class="menu-card">
              <img src="<?= $baseURL . '/' . $p['img'] ?>" alt="<?= $p['nama'] ?>" class="featured-img">
              <div class="card-content">
                <h3><?= $p['nama'] ?></h3>
                <p class="excerpt"><?= $p['desc'] ?></p>
                <a href="<?= $baseURL ?>/<?= $p['kategori'] ?>/<?= $p['slug'] ?>" class="read-more">Lihat Produk</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Tidak ada produk ditemukan untuk pencarian ini.</p>
      <?php endif; ?>
    </div>
  </main>

  <aside class="sidebar">
    <h3>Pencarian Populer</h3>
    <ul>
      <li><a href="<?= $baseURL ?>/search?q=skincare">Skincare</a></li>
      <li><a href="<?= $baseURL ?>/search?q=elektronik">Elektronik</a></li>
      <li><a href="<?= $baseURL ?>/search?q=fashion">Fashion</a></li>
      <li><a href="<?= $baseURL ?>/search?q=otomotif">Otomotif</a></li>
    </ul>
  </aside>
</div>
