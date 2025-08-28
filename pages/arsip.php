<h2>Arsip Artikel</h2>
<ul>
<?php
$arsip = [
    ['slug'=>'cara-memilih-laptop','judul'=>'Cara Memilih Laptop yang Tepat','tanggal'=>'2025-08-27'],
    ['slug'=>'tips-fashion-pria','judul'=>'Tips Fashion Pria','tanggal'=>'2025-08-20'],
];

foreach($arsip as $a): ?>
  <li>
    <a href="<?= $baseURL ?>/<?= date('Y/m/d', strtotime($a['tanggal'])) ?>/<?= $a['slug'] ?>">
      <?= $a['judul'] ?? 'Artikel' ?>
    </a>
    (<?= $a['tanggal'] ?>)
  </li>
<?php endforeach; ?>
</ul>
