<?php
session_start();
$lifetime = 3600;
// ini_set('display_errors', 'off');
// error_reporting(0);
if (isset($_COOKIE['id_auth_user'])) {
    App\User::authWithCookie($_COOKIE['id_auth_user']);
}

$messages_arr = getMessagesArr();

// *** finding of user location ***

$server = $_SERVER['REMOTE_ADDR'];
$rrs = file_get_contents("http://api.sypexgeo.net/json/?" . $server);
$obj = json_decode($rrs);
$_SESSION['city'] = $obj->city->name_ru;

//
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once('./templates/links/links_css.tpl.php') ?>
    <?php include_once('./templates/links/links_favicon.tpl.php') ?>
    <title><?php print_r(ltrim($_SERVER['REQUEST_URI'], "/"))?></title>
</head>

<body>
    <div class="container_grid">
        <div class="header">
            <header>
                <div>
                    <div id="info_time">
                        <div>
                            <p><span id='city'><?php isset($_SESSION['city']) ? print_r($_SESSION['city']) : '' ?></span>&nbsp;<span id="output"></p>
                            <p id="time_clt"></p>
                        </div>
                    </div>
                    <div class="wrap_btn">
                        <?php if (!isset($_SESSION['user_name'])) : ?>
                            <a href="/login" class="btn_auth">Авторизация</a>
                            <a href="/register" class="btn_auth">Регистрация</a>
                        <?php else : ?>
                            <a href="/logout" class="btn_auth">Выход</a>
                            <a href="/profile" class="btn_auth" id="message_btn_hed">Мой профиль</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['admin'])) : ?>
                            <a href="/admin" class="btn_auth">Admin панель</a>
                        <?php endif; ?>
                        <?php if (isset($messages_arr)) : ?>
                            <?php for ($i=0; $i < count($messages_arr); $i++) :?>
                                <?php if (isset($_SESSION['id']) && ($_SESSION['id'] == $messages_arr[$i]['id_user'])) : ?>
                                    <a href="/user/show_message?id=<?php print_r($_SESSION['id']) ?>" style="background:transparent;cursor: pointer;display:block" class="btn_auth">Сообщения</a>
                                    <?php include_once "templates/links/links_message_icon.tpl.php" ?>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
            </header>
            <div class="category">
                <div class="cont_logo">
                    <?php include_once "templates/links/links_logo.tpl.php" ?>
                </div>
                <div class="nav">
                    <a href="/" class="navs">Главная</a>
                    <a href="/support" class="navs">Помощь порталу</a>
                    <a href="/black_list" class="navs">Черный список работодателей</a>
                    <a href="/document" class="navs">Документация</a>
                </div>
            </div>
        </div>
