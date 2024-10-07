<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB;
use App\Controller\SendFeedBackEmail as SendEmail;

class Main
{
    /**
     * index
     *
     * @return void
     */
    public static function index()
    {
        require_once "../templates/index.tpl.php";
    }
    
    /**
     * showRulesPage
     *
     * @return void
     */
    public static function showRulesPage()
    {
        require_once "../templates/rules.tpl.php";
    }
    
    /**
     * showSuppotrPage
     *
     * @return void
     */
    public static function showSupportPage()
    {
        require_once "../templates/support.tpl.php";
    }
    
    /**
     * showBlackListPage
     *
     * @return void
     */
    public static function showBlackListPage()
    {
        require_once "../templates/black_list.tpl.php";
    }
    
    /**
     * showDocumentPage
     *
     * @return void
     */
    public static function showDocumentPage()
    {
        require_once "../templates/document.tpl.php";
    }
    
    /**
     * showFeedbackPage
     *
     * @return void
     */
    public static function showFeedbackPage()
    {
        if (isset($_SESSION['id'])) {
            $sql = [];
            $sql['sql'] = "SELECT users.user_name,users.user_email FROM `users` WHERE users.user_id=:id_user";
            $sql['param'] = [
                'id_user' => $_SESSION['id'],
            ];
            $arrayUser = DB::Select($sql['sql'], $sql['param']);
        }
        require_once "../templates/feedback.tpl.php";
    }


    /**
     * @return void
     */
    public static function sendEmail(): void
    {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $user_message = htmlspecialchars(trim($_POST['message']));
        SendEmail::sendFeedBackEmail($email, $name, $user_message);
    }
}
