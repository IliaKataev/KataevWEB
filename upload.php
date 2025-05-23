<?php
require_once 'functions/image.php';

$imagesDir = __DIR__ . '/images/';
$thumbsDir = $imagesDir . 'thumbs/';

if (!is_dir($thumbsDir)) {
    mkdir($thumbsDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $result = handleUpload($_FILES['image'], $imagesDir, $thumbsDir);
    if ($result === true) {
        header("Location: index.php");
    } else {
        header("Location: index.php?error=" . urlencode($result));
    }
    exit;
}
?>