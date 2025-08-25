<?php
include "data/products.php";

// Sidebar: 3 produk terbaru
$sidebar_items = array_slice(array_reverse($products), 0, 3);

// Pagination
$perPage = 6;
$pageNum = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $perPage);

// Slice
$start = ($pageNum - 1) * $perPage;
$display_products = array_slice(array_reverse($products), $start, $perPage);
?>

<div class="layout">
    <main class="main">
        <h2>Semua Produk</h2>
        <div class="row">
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
        </div>

        <?php if($totalPages > 1): ?>
            <div style="text-align:center; margin-top:20px;">
                <?php for($i=1; $i<=$totalPages; $i++): ?>
                    <a href="index.php?page=arsip&hal=<?= $i ?>" 
                       style="margin:0 5px; padding:5px 10px; background:#e91414; color:white; text-decoration:none; border-radius:5px;"
                       <?= $i == $pageNum ? 'style="background:#0a0202;"' : '' ?>>
                       <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </main>

    <aside class="sidebar">
        <h3>Produk Terbaru</h3>
        <ul>
            <?php foreach ($sidebar_items as $item): ?>
                <li><a href="index.php?page=produk&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</div>
