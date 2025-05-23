<?php
require_once 'functions/log.php';
require_once 'functions/image.php';

$imagesDir = __DIR__ . '/images/';
$thumbsDir = $imagesDir . 'thumbs/';

logRequest();

$images = getImages($imagesDir, $thumbsDir);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Фотогалерея</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .gallery a {
            border: 1px solid #ccc;
            padding: 5px;
        }

        .gallery img {
            max-width: 150px;
            height: auto;
        }

        form {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            max-width: 400px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Фотогалерея</h1>

    <div class="gallery">
        <?php foreach ($images as $img): ?>
            <a href="<?= htmlspecialchars($img['original']) ?>" target="_blank">
                <img src="<?= htmlspecialchars($img['thumb']) ?>" alt="">
            </a>
        <?php endforeach; ?>
    </div>

    <form method="post" action="upload.php" enctype="multipart/form-data">
        <h2>Загрузить новое изображение</h2>
        <?php if (!empty($_GET['error'])): ?>
            <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/jpeg,image/png,image/gif" required>
        <br>
        <button type="submit">Загрузить</button>
    </form>
</body>

</html>