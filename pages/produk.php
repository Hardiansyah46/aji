<?php
include "data/products.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cari produk utama
$product = null;
foreach ($products as $p) {
    if ($p['id'] === $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    echo "<p>Produk tidak ditemukan.</p>";
    return;
}

// Sidebar: 3 produk terbaru kecuali produk yang sedang ditampilkan
$sidebar_items = array_filter(array_reverse($products), function($p) use ($id) {
    return $p['id'] !== $id;
});
$sidebar_items = array_slice($sidebar_items, 0, 3);
?>

<div class="layout">
    <!-- Konten Produk -->
    <main class="main" style="flex:1; min-width:300px;">
        <div class="produk-detail">
            <div class="main-wrapper">
            <div class="produk-container">
                <div class="produk-info">
                    <div class="produk-img">
                         <img src="<?= $product['img'] ?>" alt="<?= $product['title'] ?>">
                     </div>
                    <h2><?= $product['title'] ?></h2>
                    <p class="produk-desc"><?= $product['full_desc'] ?? $product['desc'] ?></p>
                    <p>Harga: <?= $product['price'] ?? '-' ?></p>
                    <a href="<?= $product['link'] ?>" class="btn-beli" target="_blank">Beli Sekarang</a>
                    <a href="index.php?page=home" class="btn-back">Kembali</a>
                </div>
            </div>
        </div>
    </main>

    <aside class="sidebar">
    <h3>Produk Lainnya</h3>
    <ul>
        <?php foreach ($sidebar_items as $item): ?>
            <li>
                <a href="index.php?page=produk&id=<?= $item['id'] ?>" style="display:flex; gap:10px; align-items:center;">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
                    <span style="font-size:0.95rem; color:#333;"><?= $item['title'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
 </div>
</div>
