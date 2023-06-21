<?php
session_start();
unset($_SESSION['user_name']);
session_destroy();
setcookie('id_auth_user', '', time());
header("location:./");
