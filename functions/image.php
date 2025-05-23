<?php

function getImages($dir, $thumbsDir)
{
    $images = [];
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            $filePath = $dir . $file;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (is_file($filePath) && in_array($ext, $allowedExts) && $file !== 'thumbs') {
                $thumbPath = $thumbsDir . $file;
                if (!file_exists($thumbPath)) {
                    createThumbnail($filePath, $thumbPath);
                }

                $images[] = [
                    'original' => 'images/' . $file,
                    'thumb' => 'images/thumbs/' . $file
                ];
            }
        }
        closedir($handle);
    }

    return $images;
}

function createThumbnail($srcPath, $thumbPath, $thumbWidth = 150)
{
    $info = getimagesize($srcPath);
    if (!$info)
        return false;

    list($width, $height) = $info;
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $srcImage = imagecreatefromjpeg($srcPath);
            break;
        case 'image/png':
            $srcImage = imagecreatefrompng($srcPath);
            break;
        case 'image/gif':
            $srcImage = imagecreatefromgif($srcPath);
            break;
        default:
            return false;
    }

    $thumbHeight = floor($height * ($thumbWidth / $width));
    $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);

    if ($mime === 'image/png' || $mime === 'image/gif') {
        imagecolortransparent($thumbImage, imagecolorallocatealpha($thumbImage, 0, 0, 0, 127));
        imagealphablending($thumbImage, false);
        imagesavealpha($thumbImage, true);
    }

    imagecopyresampled(
        $thumbImage,
        $srcImage,
        0,
        0,
        0,
        0,
        $thumbWidth,
        $thumbHeight,
        $width,
        $height
    );

    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($thumbImage, $thumbPath, 85);
            break;
        case 'image/png':
            imagepng($thumbImage, $thumbPath);
            break;
        case 'image/gif':
            imagegif($thumbImage, $thumbPath);
            break;
    }

    imagedestroy($srcImage);
    imagedestroy($thumbImage);
    return true;
}

function handleUpload($file, $imagesDir, $thumbsDir)
{
    $maxSize = 5 * 1024 * 1024;
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if ($file['error'] !== UPLOAD_ERR_OK)
        return 'Ошибка загрузки.';
    if (!in_array($file['type'], $allowedTypes))
        return 'Недопустимый тип файла.';
    if ($file['size'] > $maxSize)
        return 'Файл слишком большой. Максимум 5 Мб.';

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
        return 'Недопустимое расширение.';

    $newName = uniqid('img_') . '.' . $ext;
    $destination = $imagesDir . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination))
        return 'Ошибка сохранения файла.';
    if (!createThumbnail($destination, $thumbsDir . $newName))
        return 'Ошибка миниатюры.';

    return true;
}
