<?php
include "data/products.php";

// Tentukan kategori
$kategori = "otomotif";

// Filter produk sesuai kategori
$kategori_products = array_filter($products, fn($p) => $p['category'] === $kategori);

// Sidebar: 3 produk terbaru
$sidebar_items = array_slice(array_reverse($kategori_products), 0, 3);

// Pagination
$perPage = 6;
$pageNum = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$totalProducts = count($kategori_products);
$totalPages = ceil($totalProducts / $perPage);

// Slice untuk halaman saat ini
$start = ($pageNum - 1) * $perPage;
$display_products = array_slice(array_reverse($kategori_products), $start, $perPage);
?>

<div class="layout">
    <main class="main">
        <h2>Produk <?= ucfirst($kategori) ?></h2>
        <div class="row">
            <?php if (!empty($display_products)): ?>
                <?php foreach ($display_products as $p): ?>
                    <div class="menu-card">
                        <img src="<?= $p['img'] ?>" alt="<?= $p['title'] ?>" class="featured-img">
                        <div class="card-content">
                            <h3><?= $p['title'] ?></h3>
                            <p class="excerpt"><?= $p['desc'] ?></p>
                            <a href="index.php?page=produk&id=<?= $p['id'] ?>" class="read-more">Lihat Produk</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($totalPages > 1): ?>
            <div class="pagination">
                <?php for($i=1; $i<=$totalPages; $i++): ?>
                    <a href="index.php?page=<?= $kategori ?>&hal=<?= $i ?>" class="<?= $i==$pageNum ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Sidebar -->
    <aside class="sidebar">
        <h3>Produk Terbaru</h3>
        <ul>
            <?php foreach ($sidebar_items as $item): ?>
                <li><a href="index.php?page=produk&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</div>
