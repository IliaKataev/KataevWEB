<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>

<body>
    <h1><?= $heading ?></h1>
    <p>Текущий год: <?= $year ?></p>
    <p>Сейчас: <?= getTimeWithWords() ?></p>
</body>

</html>