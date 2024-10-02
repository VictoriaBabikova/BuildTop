<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB;

class Admin
{
    /**
     * showAdminPage
     *
     * @return void
     */
    public static function showAdminPage()
    {
        $sql = [];

        $sql['sql'] = "SELECT * FROM `users`";
        $user_info_arr = DB::Select($sql['sql']);

        $sql['sql'] = "SELECT * FROM `topics_moder` where topic_id = (SELECT MIN(topic_id) FROM `topics_moder`)";
        $topics_moder = DB::Select($sql['sql']);

        $sql['sql']="SELECT * FROM `categories`";
        $category = DB::Select($sql['sql']);

        $sql['sql'] = "SELECT * FROM `orders_moder`";
        $order_moder_list = DB::Select($sql['sql']);

        require_once "../templates/admin.tpl.php";
    }
    
    /**
     * topicToModer
     *
     * @return void
     */
    public static function topicToModer()
    {
        $sql = [];
        
        $sql['sql'] = "SELECT * FROM `topics_moder` where topic_id = (SELECT MIN(topic_id) FROM `topics_moder`)";
        $topics_moder = DB::Select($sql['sql']);

        if (isset($_POST['topic_to_moder_base'])) {
            if (isset($_POST['name_topic']) && isset($_POST['category'])) {
                $sql['sql'] = "INSERT INTO `topics` (topics.topic_subject,topics.topic_date, topics.topic_cat,topics.topic_by) VALUES (:name_topic,:dates,:id_cat,:name_user)";
                $sql['param'] = [
                    'dates' => $topics_moder[0]['topic_date'],
                    'name_topic' => htmlspecialchars(trim($_POST['name_topic'])),
                    'id_cat' => htmlspecialchars(trim($_POST['category'])),
                    'name_user' => $topics_moder[0]['topic_by'],
                ];
                DB::Query($sql['sql'], $sql['param']);
        
                $sql['sql'] = "DELETE FROM `topics_moder` WHERE topic_subject = :name_topic and topic_cat = :id_cat";
                $sql['param'] = [
                    'name_topic' => htmlspecialchars(trim($_POST['name_topic'])),
                    'id_cat' => htmlspecialchars(trim($_POST['category'])),
                ];
                DB::Query($sql['sql'], $sql['param']);
        
                header('Location: /admin');
            }
        }
        if (isset($_POST['topic_to_moder_delete'])) {
            if (isset($_POST['name_topic']) && isset($_POST['category'])) {
                $sql['sql'] = "DELETE FROM `topics_moder` WHERE topic_subject = :name_topic and topic_cat = :id_cat";
                $sql['param'] = [
                    'name_topic' => htmlspecialchars(trim($_POST['name_topic'])),
                    'id_cat' => htmlspecialchars(trim($_POST['category'])),
                ];
                DB::Query($sql['sql'], $sql['param']);

                header('Location: /admin');
            }
        }
    }
    
    /**
     * changeCategory
     *
     * @return void
     */
    public static function changeCategory()
    {
        $sql = [];
        if (isset($_POST['change_category'])) {
            if (isset($_POST['name_category']) && isset($_POST['subject_category'])) {
                $sql['sql'] = "INSERT INTO `categories` (categories.cat_name,categories.cat_description) VALUES (:name_category,:subject_category)";
                $sql['param'] = [
                    'name_category' => htmlspecialchars(trim($_POST['name_category'])),
                    'subject_category' => htmlspecialchars(trim($_POST['subject_category'])),
                ];
                DB::Query($sql['sql'], $sql['param']);

                header('Location: /admin');
            }
        }
    }
    
    /**
     * orderToModer
     *
     * @return void
     */
    public static function orderToModer()
    {
        $sql = [];
        if (isset($_POST['order_to_moder_base'])) {
            if (isset($_POST['order_city']) && isset($_POST['order_tel']) && isset($_POST['order_content']) && isset($_POST['id'])) {
                $sql['sql'] = "INSERT INTO `orders`(orders.order_content, orders.order_date, orders.order_city, orders.order_tel, orders.order_by) VALUES (:order_content,NOW(),:order_city,:order_tel,:order_by)";
                $sql['param'] = [
                    'order_city' => htmlspecialchars(trim($_POST['order_city'])),
                    'order_tel' => htmlspecialchars(trim($_POST['order_tel'])),
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];
        
                DB::Query($sql['sql'], $sql['param']);
            }
            $sql['sql'] = "DELETE FROM `orders_moder` WHERE orders_moder.order_content =:order_content and orders_moder.order_by =:order_by";
            $sql['param'] = [
                'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                'order_by' => htmlspecialchars(trim($_POST['id'])),
            ];
                DB::Query($sql['sql'], $sql['param']);
        
            header('Location: /admin');
        }

        // sql for make message from admin to user table `messages` and also added table `orders_moder_redact`
        if (isset($_POST['order_to_moder_change'])) {
            $message_from = $_SESSION['id'];
            if (isset($_POST['order_city']) && isset($_POST['order_tel']) && isset($_POST['order_content']) && isset($_POST['id']) && isset($_POST['message'])) {
                $sql['sql'] = "INSERT INTO `messages`(messages.id_user, messages.message_date, messages.message_content, messages.message_from) VALUES (:id_user,NOW(),:message_content,:message_from)";
                $sql['param'] = [
                    'id_user' => htmlspecialchars(trim($_POST['id'])),
                    'message_content' => htmlspecialchars(trim($_POST['message'])),
                    'message_from' => $message_from,
                ];

                DB::Query($sql['sql'], $sql['param']);

                $sql['sql'] = "DELETE FROM `orders_moder` WHERE orders_moder.order_content =:order_content and orders_moder.order_by =:order_by";
                $sql['param'] = [
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];
                DB::Query($sql['sql'], $sql['param']);

                $sql['sql'] = "INSERT INTO `orders_moder_redact`(orders_moder_redact.order_content, orders_moder_redact.order_date, orders_moder_redact.order_city, orders_moder_redact.order_tel, orders_moder_redact.order_by) VALUES (:order_content,NOW(),:order_city,:order_tel,:order_by)";
                $sql['param'] = [
                    'order_city' => htmlspecialchars(trim($_POST['order_city'])),
                    'order_tel' => htmlspecialchars(trim($_POST['order_tel'])),
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];

                DB::Query($sql['sql'], $sql['param']);

                header('Location:/admin');
            }
        }

        if (isset($_POST['order_to_moder_delete'])) {
            if (isset($_POST['order_city']) && isset($_POST['order_tel']) && isset($_POST['order_content']) && isset($_POST['id'])) {
                $sql['sql'] = "DELETE FROM `orders_moder` WHERE orders_moder.order_content =:order_content and orders_moder.order_by =:order_by";
                $sql['param'] = [
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];
                DB::Query($sql['sql'], $sql['param']);
        
                header('Location: /admin');
            }
        }
    }

    public static function getMessagesArr(): array
    {
        $sql = [];
        $sql['sql'] = 'SELECT * FROM `messages`';
        return $messages_arr =  DB::Select($sql['sql']);
    }
}
