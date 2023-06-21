<?php if (substr_count($_SERVER['REQUEST_URI'], '/') == 1) : ?>
    <script type="text/javascript" src="script_3.js"></script>
<?php elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 2) : ?>
    <script type="text/javascript" src="../script_3.js"></script>
<?php endif; ?>

<?php if ($_SERVER['REQUEST_URI'] == '/profile') : ?>
    <script type="text/javascript" src="script.js"></script>
<?php elseif ($_SERVER['REQUEST_URI'] == '/feedback') : ?>
    <script type="text/javascript" src="send_form.js"></script>
<?php elseif ($_SERVER['REQUEST_URI'] == '/register' || $_SERVER['REQUEST_URI'] == '/login') : ?>
    <script type="text/javascript" src="script_2.js"></script>
<?php endif ?>