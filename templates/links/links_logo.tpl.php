<?php if (substr_count($_SERVER['REQUEST_URI'], '/') == 1) : ?>
    <img src="./img/logo2.png" width="250" alt="Logo_here">
<?php elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 2) : ?>
    <img src="../img/logo2.png" width="250" alt="Logo_here">
<?php endif; ?>