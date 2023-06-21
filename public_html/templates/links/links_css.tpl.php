<?php if (substr_count($_SERVER['REQUEST_URI'], '/') == 1) : ?>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/styleMedia.css">
<?php elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 2) : ?>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleMedia.css">
<?php endif; ?>
