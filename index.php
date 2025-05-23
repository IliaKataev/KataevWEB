<?php
include "menu.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List Item</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="list-items" id="list-items">

    </div>

    <script>
        const menu = <?= $menu ?>;
    </script>
    <script src="index.js"></script>
</body>

</html>