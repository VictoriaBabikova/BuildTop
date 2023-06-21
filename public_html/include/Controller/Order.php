<?php

namespace App;

require_once "./include/autoload.php";
require_once "./include/db.php";
require_once "./include/function.php";
require_once "./include/config.php";

class Order
{
    
    /**
     * showOrderListPage
     *
     * @return void
     */
    public static function showOrderListPage()
    {
        $sql = [];
        $sql['sql'] = "SELECT * FROM `users`";
        $user_info_arr = Select($sql['sql']);

        $sql['sql'] = 'SELECT * FROM `orders`';
        $orders = Select($sql['sql']);

        require_once "templates/order_list.tpl.php";
    }
    
    /**
     * showOrderPage
     *
     * @return void
     */
    public static function showOrderPage()
    {
        require_once "templates/order.tpl.php";
    }
    
    /**
     * addOrderToModer
     *
     * @return void
     */
    public static function addOrderToModer()
    {
        if (isset($_POST['order_city']) && isset($_POST['order_tel']) && isset($_POST['order_content']) && isset($_POST['id'])) {
            $sql['sql'] = "INSERT INTO `orders_moder`(orders_moder.order_content, orders_moder.order_date, orders_moder.order_city, orders_moder.order_tel, orders_moder.order_by) VALUES (:order_content,NOW(),:order_city,:order_tel,:order_by)";
            $sql['param'] = [
                'order_city' => htmlspecialchars(trim($_POST['order_city'])),
                'order_tel' => htmlspecialchars(trim($_POST['order_tel'])),
                'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                'order_by' => htmlspecialchars(trim($_POST['id'])),
            ];
    
            Query($sql['sql'], $sql['param']);
        }
        header('Location: /order_list');
    }
    
    /**
     * addOrderToModerAgain
     *
     * @return void
     */
    public static function addOrderToModerAgain()
    {
        if (isset($_POST['order_to_moder_again'])) {
            if (isset($_POST['order_city']) && isset($_POST['order_tel']) && isset($_POST['order_content']) && isset($_POST['id'])) {
                $sql['sql'] = "INSERT INTO `orders_moder`(orders_moder.order_content, orders_moder.order_date, orders_moder.order_city, orders_moder.order_tel, orders_moder.order_by) VALUES (:order_content,NOW(),:order_city,:order_tel,:order_by)";
                $sql['param'] = [
                    'order_city' => htmlspecialchars(trim($_POST['order_city'])),
                    'order_tel' => htmlspecialchars(trim($_POST['order_tel'])),
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];
        
                Query($sql['sql'], $sql['param']);
        
                $sql['sql'] = "DELETE FROM `orders_moder_redact` WHERE orders_moder_redact.order_content =:order_content and orders_moder_redact.order_by =:order_by";
                $sql['param'] = [
                    'order_content' => htmlspecialchars(trim($_POST['order_content'])),
                    'order_by' => htmlspecialchars(trim($_POST['id'])),
                ];
                Query($sql['sql'], $sql['param']);
        
                $sql['sql']= "DELETE FROM `messages` WHERE messages.id_user = :id_user";
                $sql['param'] = [
                    'id_user' => htmlspecialchars(trim($_POST['id'])),
                ];
        
                Query($sql['sql'], $sql['param']);
        
                unlink("./templates/user_messages/message_user_" . $_POST['id'] . ".tpl.php");
                header('Location: /order_list');
            }
        }
    }
}
