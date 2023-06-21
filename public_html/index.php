<?php

require_once "include/autoload.php";
require_once "include/function.php";

$arguments = [];
$arguments['id_topic'] = null;
$arguments['id'] = null;
$arguments['email'] = null;
$arguments['user_name'] = null;


$URIParts = explode('?', $_SERVER['REQUEST_URI']);

if (! empty($URIParts)) {
    if (isset($URIParts[1])) {
        $params = $URIParts[1];
        $getParamArr = parseApplicationContent($params);
        foreach ($getParamArr as $key => $value) {
            if ($key == "id_topic") {
                $arguments['id_topic'] = $value;
            } elseif ($key == "email") {
                $arguments['email'] = $value;
            } elseif ($key == "user_name") {
                $arguments['user_name'] = $value;
            } elseif ($key == "id") {
                $arguments['id'] = $value;
            }
        }
    }
}

$urlList = [
    "/" => [
        'GET' => "Main::index",
    ],
    "/user?id=". $arguments['id'] => [
        'GET' => "User::deleteUser",
    ],
    "/user/show_message?id=". $arguments['id'] => [
        'GET' => "User::showMessagePage",
    ],
    "/register" => [
        'GET' => "User::showRegisterPage",
        'POST' => "User::addUser",
    ],
    "/login" => [
        'GET' => "User::showAuthPage",
        'POST' => "User::login",
    ],
    "/intropage" => [
        'GET' => "User::intropage"
    ],
    "/logout" => [
        'GET' => "User::logout",
    ],
    "/profile" => [
        'GET' => "User::getUser",
        'POST' => "User::changeUser",
    ],
    "/reset_password" => [
        'GET' => "User::showResetPasswordPage",
        'POST' => "User::resetPassword",
    ],
    "/change_password?email=". $arguments['email']."&user_name=". $arguments['user_name'] => [
        'GET' => "User::showChangePasswordPage",
    ],
    "/save_password" => [
        'POST' => "User::changePassword",
    ],
    "/rules" => [
        'GET' => "Main::showRulesPage",
    ],
    "/support" => [
        'GET' => "Main::showSuppotrPage",
    ],
    "/black_list" => [
        'GET' => "Main::showBlackListPage",
    ],
    "/document" => [
        'GET' => "Main::showDocumentPage",
    ],
    "/forum" => [
        'GET' => "Forum::showForumPage",
    ],
    "/forum/topic_page?id_topic=".$arguments['id_topic'] => [
        'GET' => "Forum::getTopic",
    ],
    "/add_topic" => [
        'GET' => "Forum::showNewTopicFormPage",
        'POST' => "Forum::addTopic",
    ],
    "/post?id_topic=" .$arguments['id_topic'] => [
        'GET' => "Forum::showPostPage",
    ],
    "/add_post" => [
        'POST' => "Forum::addPost",
    ],
    "/order_list" => [
        'GET' => "Order::showOrderListPage",
    ],
    "/order" => [
        'GET' => "Order::showOrderPage",
    ],
    "/add_order_to_moder" => [
        'POST' => "Order::addOrderToModer",
    ],
    "/add_order_to_moder_again" => [
        'POST' => "Order::addOrderToModerAgain",
    ],
    "/feedback" => [
        'GET' => "Main::showFeedbackPage",
    ],
    "/send_message" => [
        'POST' => "Main::sendEmail",
    ],
    "/admin" => [
        'GET' => "Admin::showAdminPage",
    ],
    "/admin/topic_to_moder" => [
        'POST' => "Admin::topicToModer",
    ],
    "/admin/change_category" => [
        'POST' => "Admin::changeCategory",
    ],
    "/admin/order_to_moder" => [
        'POST' => "Admin::orderToModer",
    ]
];

$arrHandlerJS = [
    "/send_message",
];

if (!array_key_exists($_SERVER['REQUEST_URI'], $urlList)) {
    require_once "templates/404_page.tpl.php";
}

foreach ($arguments as $key => $argument) {
    if ($argument === null) {
        unset($arguments[$key]);
    }
}

if (in_array($_SERVER['REQUEST_URI'], $arrHandlerJS)) {
    foreach ($urlList as $key => $uri) {
        if ($_SERVER['REQUEST_URI'] === $key) {
            foreach ($uri as $key => $value) {
                if ($_SERVER['REQUEST_METHOD'] === $key) {
                    call_user_func('App\\'. $value, ...$arguments);
                }
            }
        }
    }
} else {
    foreach ($urlList as $key => $uri) {
        if ($_SERVER['REQUEST_URI'] === $key) {
            foreach ($uri as $key => $value) {
                if ($_SERVER['REQUEST_METHOD'] === $key) {
                    require_once "templates/header.tpl.php";
                    require_once "templates/bar_menu.tpl.php";
                    call_user_func('App\\'. $value, ...$arguments);
                    require_once "templates/footer.tpl.php";
                }
            }
        }
    }
}
