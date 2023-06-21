<?php if (substr_count($_SERVER['REQUEST_URI'], '/') == 1) : ?>
    <img src="./img/message.png" width="35" alt="message_icon" id="message_icon">
<?php elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 2) : ?>
    <img src="../img/message.png" width="35" alt="message_icon" id="message_icon">
<?php endif; ?>