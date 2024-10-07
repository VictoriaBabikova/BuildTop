<?php

declare(strict_types=1);

use App\Route;

Route::get("/", "Main::index");

Route::get("/forum/topic_page?". Route::addArgumentToList('id_topic'), "Forum::getTopic");
Route::get("/forum", "Forum::showForumPage");

Route::get("/user?". Route::addArgumentToList('id'), "User::deleteUser");
Route::get("/user/show_message?". Route::addArgumentToList('id'), "User::showMessagePage");

Route::get("/register", "User::showRegisterPage");
Route::post("/register", "User::addUser");

Route::get("/login", "User::showAuthPage");
Route::post("/login", "User::login");

Route::get("/logout", "User::logout");

Route::get("/intropage", "User::intropage");

Route::get("/profile", "User::getUser");
Route::post("/profile", "User::changeUser");

Route::get("/reset_password", "User::showResetPasswordPage");
Route::post("/reset_password", "User::resetPassword");

Route::get("/change_password?" . Route::addArgumentToList('email') . "&" .Route::addArgumentToList('user_name'), "User::showChangePasswordPage");

Route::post("/save_password", "User::changePassword");

Route::get("/rules", "Main::showRulesPage");

Route::get("/support", "Main::showSupportPage");

Route::get("/black_list", "Main::showBlackListPage");

Route::get("/document", "Main::showDocumentPage");

Route::get("/add_topic", "Forum::showNewTopicFormPage");
Route::post("/add_topic", "Forum::addTopic");

Route::get("/post?". Route::addArgumentToList('id_topic'), "Forum::showPostPage");

Route::post("/add_post", "Forum::addPost");

Route::get("/order_list", "Order::showOrderListPage");

Route::get("/order", "Order::showOrderPage");

Route::post("/add_order_to_moder", "Order::addOrderToModer");

Route::post("/add_order_to_moder_again", "Order::addOrderToModerAgain");

Route::get("/feedback", "Main::showFeedbackPage");

Route::get("/admin", "Admin::showAdminPage");

Route::post("/admin/topic_to_moder", "Admin::topicToModer");

Route::post("/admin/change_category", "Admin::changeCategory");

Route::post("/admin/order_to_moder", "Admin::orderToModer");

Route::post("/send_message", "Main::sendEmail", true);
