<?php
namespace App;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

require '././vendor/autoload.php';

class SendResetPasswordMail
{
    public static function sendResetPasswordMail($email, $name)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('ru', '././vendor/phpmailer/phpmailer/language/');
        $mail->IsHTML(true);

        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        $mail->Host = 'smtp.gmail.com';

        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = 'buildtop.info@gmail.com';

        $mail->Password = 'kxmjnexioohbj****';

        $mail->setFrom('buildtop.info@gmail.com');
        $mail->addAddress($email);
        $mail->addReplyTo($email, $name);

        //Content
                                        
        $mail->Subject = 'Восстановление пароля';
        $body = '';
        if (trim(!empty($name)) && trim(!empty($email))) {
            $body .= '<p>Привет ' . $name . '! Мы отправили Вам ссылку для восстановления пароля </p><br>';
            $body .= "<p><a href=\"http://buildtop/change_password?email=$email&user_name=$name\">Вперёд! Восстановите пароль!</a></p>";
        }

        $mail->Body = $body;
        if (!$mail->send()) {
            $message = 'Что-то пошло не так, повторите еще раз, пожалуйста';
        } else {
            $message = 'Мы отправили Вам ссылку для восстановления пароля на Ваш email';
        }

        return $message;
    }
}
