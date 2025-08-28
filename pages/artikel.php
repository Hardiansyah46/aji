<?php
include __DIR__ . "/../data/artikel.php";

// Cari artikel berdasarkan slug & tanggal
$artikel = null;
foreach($artikel_list as $a) {
    if($a['slug'] === $slug && $a['tanggal'] === "$tahun-$bulan-$hari") {
        $artikel = $a;
        break;
    }
}

if(!$artikel) {
    echo "<p>Artikel tidak ditemukan.</p>";
    return;
}
?>

<div class="layout">
  <main class="main">
    <div class="artikel-detail">
      <h2><?= $artikel['judul'] ?? 'Artikel' ?></h2>
      <p class="tanggal">Tanggal: <?= $artikel['tanggal'] ?></p>
      <p class="artikel-desc"><?= $artikel['full_desc'] ?? '-' ?></p>
      <a href="<?= $baseURL ?>/arsip" class="btn-back">Kembali ke Arsip</a>
    </div>
  </main>
</div>
