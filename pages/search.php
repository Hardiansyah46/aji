<?php
include "data/products.php";

$keyword = strtolower($_GET['q'] ?? '');
$results = [];

if ($keyword !== '') {
    foreach ($products as $p) {
        if (
            strpos(strtolower($p['title']), $keyword) !== false ||
            strpos(strtolower($p['desc']), $keyword) !== false
        ) {
            $results[] = $p;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($results);
?>
