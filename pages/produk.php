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

<div class="layout" style="display:flex; gap:2rem; flex-wrap:wrap;">
    <!-- Konten Produk -->
    <main class="main" style="flex:1; min-width:300px;">
        <div class="produk-detail">
            <div class="produk-container">
                <div class="produk-img">
                    <img src="<?= $product['img'] ?>" alt="<?= $product['title'] ?>">
                </div>
                <div class="produk-info">
                    <h2><?= $product['title'] ?></h2>
                    <p class="produk-desc"><?= $product['full_desc'] ?? $product['desc'] ?></p>
                    <p>Harga: <?= $product['price'] ?? '-' ?></p>
                    <a href="<?= $product['link'] ?>" class="btn-beli" target="_blank">Beli Sekarang</a>
                    <a href="index.php?page=home" class="btn-back">Kembali</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Sidebar -->
    <aside class="sidebar" style="width:250px; min-width:200px;">
        <h3>Produk Lainnya</h3>
        <ul style="list-style:none; padding:0;">
            <?php foreach ($sidebar_items as $item): ?>
                <li style="margin-bottom:15px; display:flex; gap:10px; align-items:center;">
                    <a href="index.php?page=produk&id=<?= $item['id'] ?>" style="display:flex; gap:10px; align-items:center;">
                        <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
                        <span style="font-size:0.95rem; color:#333;"><?= $item['title'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</div>
<style>
/* ================= Halaman Produk ================= */
/* Sidebar */
.sidebar {
    background: #fff;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.sidebar h3 {
    margin-bottom: 1rem;
    color: #007bff;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar li {
    margin-bottom: 15px;
}

.sidebar li img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}

.sidebar li span {
    font-size: 0.95rem;
    color: #333;
}

/* Layout Flex */
.layout {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

/* Responsive */
@media (max-width: 768px) {
    .produk-container {
        flex-direction: column;
        align-items: center;
    }
    .produk-img img {
        max-width: 100%;
    }
    .layout {
        flex-direction: column;
    }
    .sidebar {
        width: 100%;
    }
}
</style>

<?php
// kode PHP produk sama sidebar seperti sebelumnya
?>
