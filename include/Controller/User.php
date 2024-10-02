<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB;
use App\SendResetPasswordMail as SendResetMail;

class User
{
    /**
     * showAuthPage
     *
     * @return void
     */
    public static function showAuthPage()
    {
        require_once "../templates/auth.tpl.php";
    }
    
    /**
     * showRegisterPage
     *
     * @return void
     */
    public static function showRegisterPage()
    {
        require_once "../templates/register.tpl.php";
    }
    
    /**
     * showResetPasswordPage
     *
     * @return void
     */
    public static function showResetPasswordPage()
    {
        require_once "../templates/reset_password.tpl.php";
    }

    public static function showChangePasswordPage(string $email, string $user_name)
    {
        require_once "../templates/change_password.tpl.php";
    }
        
    /**
     * getUser
     * getting user data
     * @return void
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_name'])) {
            $name =  $_SESSION['user_name'];
            $sql['sql'] = "SELECT * from `users` WHERE user_name = '$name'";
            $arrayUser = DB::Select($sql['sql']);
            $_SESSION['id'] = $arrayUser[0]['user_id'];

            require_once "../templates/profile.tpl.php";
        } else {
            header('Location: /');
        }
    }
    
    /**
     * addUser
     * adding user to data base
     * @return void
     */
    public static function addUser()
    {
        if (htmlspecialchars(trim($_POST['text_capcha'])) !== htmlspecialchars(trim($_POST['hidden_capcha']))) {
            $message = '<b style="color: red">Ответ не правильный!</b><br>';
            require_once "templates/register.tpl.php";
        } else {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                $sql['sql'] = "SELECT * FROM `users` WHERE users.user_name =:name_user and users.user_email =:email";
                $sql['param'] = [
                    'name_user' => htmlspecialchars(trim($_POST['name'])),
                    'email' => htmlspecialchars(trim($_POST['email'])),
                ];
                $user_info = DB::Select($sql['sql'], $sql['param']);
            }
        
            if (!isset($user_info[0])) {
                if (isset($_POST['remember'])) {
                    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                        $id_auth_user = hash("sha256", microtime(true) . random_int(100, PHP_INT_MAX));
                        setcookie('id_auth_user', $id_auth_user, TIME_COOKIE, '/');
            
                        $sql['sql'] = "INSERT INTO users (users.user_name,users.user_email, users.user_pass,users.user_date,users.user_level,users.cookie) VALUES (:name_user,:email,:pass,NOW(),0,:cookie)";
                        $sql['param'] = [
                        'name_user' => htmlspecialchars(trim($_POST['name'])),
                        'email' => htmlspecialchars(trim($_POST['email'])),
                        'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'cookie' => $id_auth_user,
                        ];
            
                        DB::Query($sql['sql'], $sql['param']);
                    }
                } else {
                    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                        $sql['sql'] = "INSERT INTO users (users.user_name,users.user_email, users.user_pass,users.user_date,users.user_level) VALUES (:name_user,:email,:pass,NOW(),0)";
                        $sql['param'] = [
                        'name_user' => htmlspecialchars(trim($_POST['name'])),
                        'email' => htmlspecialchars(trim($_POST['email'])),
                        'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        ];
            
                        DB::Query($sql['sql'], $sql['param']);
                    }
                }
                $sql['sql'] = "SELECT * FROM `users` WHERE users.user_name = :name_user";
                $sql['param'] = [
                    'name_user' => htmlspecialchars(trim($_POST['name'])),
                ];
                $userData = DB::Select($sql['sql'], $sql['param']);

                $_SESSION['user_name'] = $userData[0]['user_name'];
                $_SESSION['user'] = $userData[0]['user_level'];
                $_SESSION['id'] = $userData[0]['user_id'];
                $_SESSION['auth'] = true;

                header('Location: /intropage');
            } else {
                $message_user = '<b style="color: red">Упс! Такой пользователь уже существует</b><br>';
                require_once "../templates/register.tpl.php";
            }
        }
    }
    
    /**
     * changeUser
     * changing user data from data base
     * @return void
     */
    public static function changeUser()
    {
        if (isset($_POST['ChangeProfileSubmit'])) {
            $name =  $_SESSION['user_name'];
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                $sql['sql'] = "UPDATE `users` SET `user_name`=:name_user,`user_pass`=:pass,`user_email`=:email WHERE user_name = '$name'";
                $sql['param'] = [
                    'name_user' => htmlspecialchars(trim($_POST['name'])),
                    'email' => htmlspecialchars(trim($_POST['email'])),
                    'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ];
                DB::Query($sql['sql'], $sql['param']);
                sleep(3);
            }
            $name = htmlspecialchars(trim($_POST['name']));
            $sql['sql'] = "SELECT * from `users` WHERE user_name = '$name'";
            $arrayUser = DB::Select($sql['sql']);

            require_once "../templates/profile.tpl.php";
        }
    }
    
    /**
     * deleteUser
     * deleting user from data base
     * @param  integer $id
     * @return void
     */
    public static function deleteUser(int $id)
    {
        if (isset($id)) {
            if ($_SESSION['id']== $id) {
                $sql = [];
                $sql['sql'] = "SELECT * FROM `users` WHERE users.user_id = :id";
                $sql['param'] = [
                    'id' => htmlspecialchars(trim($id)),
                ];
                $userData = DB::Select($sql['sql'], $sql['param']);

                if (!empty($userData)) {
                    $sql['sql'] = "DELETE FROM `users` WHERE users.user_id = :id";
                    $sql['param'] = [
                        'id' => htmlspecialchars(trim($id)),
                    ];
                    DB::Query($sql['sql'], $sql['param']);
                    self::logout();
                }
                header('Location: /');
            }
        }
    }
    
    /**
     * login
     *
     * @return void
     */
    public static function login()
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $sql['sql'] = "SELECT * FROM `users` WHERE users.user_name =:name_user and users.user_email =:email";
            $sql['param'] = [
                'name_user' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
            ];
            $user_info_auth = DB::Select($sql['sql'], $sql['param']);
        }

        if (isset($user_info_auth[0])) {
            if (password_verify($_POST['password'], $user_info_auth[0]['user_pass'])) {
                $_SESSION['user_name'] = $_POST['name'];
                $_SESSION['id'] = $user_info_auth[0]['user_id'];
                if (isset($user_info_auth[0]['user_level'])) {
                    if ($user_info_auth[0]['user_level'] == 1) {
                        $_SESSION['admin'] =  $user_info_auth[0]['user_level'];
                    }
                    if ($user_info_auth[0]['user_level'] == 0) {
                        $_SESSION['user'] = $user_info_auth[0]['user_level'];
                    }
                    if (isset($_POST['remember'])) {
                        if ($user_info_auth[0]['cookie'] === null) {
                            $id_auth_user = hash("sha256", microtime(true) . random_int(100, PHP_INT_MAX));
                            setcookie('id_auth_user', $id_auth_user, strtotime($_ENV['TIME_COOKIE']), '/');
                        } else {
                            $id_auth_user = $user_info_auth[0]['cookie'];
                            setcookie('id_auth_user', $id_auth_user, strtotime($_ENV['TIME_COOKIE']), '/');
                        }
                        
                        self::authWithCookie($id_auth_user, $_POST['name']);
                    }
                    header('Location: /intropage');
                }
            } else {
                $message_user = '<b style="color:red;display:block;padding: 5px 0;">не верный пароль</b>';
                require_once "../templates/auth.tpl.php";
            }
        } else {
            $message_user = '<b style="color:red;display:block;padding:5px 0;">вы не зарегистрированы в системе, пожалуйста зарегистрируйтесь</b>';
            require_once "../templates/auth.tpl.php";
        }
    }
    
    /**
     * authWithCookie
     *
     * @param  mixed $cookie
     * @param  mixed $name
     * @return void
     */
    public static function authWithCookie(string $cookie, string $name = null)
    {
        if (isset($cookie)) {
            $id_auth_user = $cookie;
            $sql = [];
            $sql['sql'] = "select * from users where users.cookie = :id_auth_user";
            $sql['param'] = [
                'id_auth_user' => $id_auth_user,
            ];
            $user_data = DB::Select($sql['sql'], $sql['param']);
        }
        if (isset($user_data[0])) {
            $_SESSION['user_name'] = $user_data[0]['user_name'];
            if ($user_data[0]['user_level'] == 1) {
                $_SESSION['admin'] =  $user_data[0]['user_level'];
            }
            if ($user_data[0]['user_level'] == 0) {
                $_SESSION['user'] = $user_data[0]['user_level'];
            }
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user_data[0]['user_id'];
        } else {
            if (isset($name)) {
                $sql['sql'] = "UPDATE `users` SET `cookie`=:cookie WHERE user_name = '$name'";
                $sql['param'] = [
                    'cookie' => $cookie,
                ];
                DB::Query($sql['sql'], $sql['param']);
                self::authWithCookie($cookie, $name);
            }
        }
    }
    
    /**
     * intropage
     *
     * @return void
     */
    public static function intropage()
    {
        require_once "../templates/intropage.tpl.php";
    }
    
    /**
     * loguot user
     *
     * @return void
     */
    public static function logout()
    {
        session_destroy();
        setcookie(session_name(), session_id());
        setcookie('id_auth_user', '', time());
        header('Location: /');
    }
    
    /**
     * resetPassword
     *
     * @param  mixed $email
     * @return void
     */
    public static function resetPassword()
    {
        if (isset($_POST['name']) && isset($_POST['email'])) {
            $sql = [];
            $sql['sql'] = "SELECT * FROM `users` WHERE users.user_name =:name_user and users.user_email =:email";
            $sql['param'] = [
                'name_user' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
            ];
            $userData = DB::Select($sql['sql'], $sql['param']);
            if (!empty($userData)) {
                $sendMail = SendResetMail::sendResetPasswordMail($_POST['email'], $_POST['name']);
                $message = $sendMail;
                require_once "../templates/reset_password.tpl.php";
            } else {
                $message_user = '<b style="color:red;display:block;padding:5px 0;">вы не зарегистрированы в системе, пожалуйста, зарегистрируйтесь</b>';
                require_once "../templates/reset_password.tpl.php";
            }
        } else {
            $message_user = '<b style="color:red;display:block;padding:5px 0;">вы не зарегистрированы в системе, пожалуйста, зарегистрируйтесь</b>';
            require_once "../templates/reset_password.tpl.php";
        }
    }
    
    /**
     * changePassword
     *
     * @return void
     */
    public static function changePassword()
    {
        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password'])) {
            $sql = [];
            $sql['sql'] = "SELECT * FROM `users` WHERE users.user_name =:name_user and users.user_email =:email";
            $sql['param'] = [
                'email' => htmlspecialchars(trim($_POST['email'])),
                'name_user' => htmlspecialchars(trim($_POST['name'])),
            ];
            $userData = DB::Select($sql['sql'], $sql['param']);

            $name = $_POST['name'];

            if (!empty($userData)) {
                $sql['sql'] = "UPDATE `users` SET `user_name`=:name_user,`user_pass`=:pass,`user_email`=:email WHERE user_name = '$name'";
                $sql['param'] = [
                    'email' => htmlspecialchars(trim($_POST['email'])),
                    'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'name_user' => htmlspecialchars(trim($_POST['name'])),
                ];
                DB::Query($sql['sql'], $sql['param']);

                $message = "Пароль успешно восстановлен!";

                require_once "../templates/auth.tpl.php";
            }
        } else {
            $message_user = '<b style="color:red;display:block;padding:5px 0;">вы не зарегистрированы в системе, пожалуйста, зарегистрируйтесь</b>';

            require_once "../templates/change_password.tpl.php";
        }
    }

    public static function showMessagePage(int $id)
    {
        if (isset($id)) {
            $sql = [];
            $sql['sql'] = 'SELECT * FROM `orders_moder_redact`';
            $order_moder_redact = DB::Select($sql['sql']);

            $messages_arr = Admin::getMessagesArr();

            $myfile = fopen("../templates/user_messages/message_user_" . $id . ".tpl.php", "c+") or die("Unable to open file!");
            $txt = "<div class='content'>
            <div class='container'>
            <?php if (isset(\$_SESSION['user']) || isset(\$_SESSION['admin'])) : ?>
                <div class ='container_message'>
                    <?php foreach (\$order_moder_redact as \$value) : ?>
                        <?php if (\$value['order_by'] == \$_SESSION['id']) : ?>
                            <form action='/add_order_to_moder_again' method='POST' id='change_order'>
                                <h3 style='text-align:center;padding-top:20px'>Ваш заказ</h3>
                                <input type='hidden' name='order_id' value='<?php print_r(\$value['order_id']) ?>' class='input_adm'>
                                <input type='hidden' name='id' value='<?php print_r(\$value['order_by']) ?>' class='input_adm'>
                                <label for='order_city'>Локация заказа</label>
                                <input type='text' name='order_city' id='order_city' value='<?php print_r(\$value['order_city']) ?>' class='input_adm'>
                                <label for='order_tel'>Контакт заказа для связи</label>
                                <input type='text' name='order_tel' id='order_tel' value='<?php print_r(\$value['order_tel']) ?>' class='input_adm'>
                                <label for='order_content'>Описание заказа </label>
                                <textarea rows='10' cols='35' name='order_content' id='order_content' required><?php print_r(\$value['order_content']) ?></textarea>
                                <input type='submit' value='ОТПРАВИТЬ НА МОДЕРАЦИЮ' id='message-button_user' name='order_to_moder_again'> 
                            </form>
                            <div class='moder_message'>
                                <h3>Сообщение от модератора</h3>
                                <?php foreach (\$messages_arr as \$value) : ?>
                                    <?php if (\$value['id_user'] == \$_SESSION['id']) : ?> 
                                        <div>
                                            <p>Ваш заказ был отклонен от публикации</p> 
                                            <h4 style= 'text-align:center'><?php print_r(\$value['message_content']) ?></h4> 
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>          
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>    
        </div>
    </div>";
        
            fwrite($myfile, $txt);
            fclose($myfile);

            require_once "../templates/user_messages/message_user_" . $id . ".tpl.php";
        }
    }
}
