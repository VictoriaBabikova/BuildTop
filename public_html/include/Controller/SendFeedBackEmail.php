<?php
namespace App;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

require '././vendor/autoload.php';

class SendFeedBackEmail
{
    public static function sendFeedBackEmail($email, $name, $user_message)
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

        $mail->setFrom($email);
        $mail->addAddress('buildtop.info@gmail.com');
        $mail->addReplyTo($email, $name);

        //Content
                                        
        $mail->Subject = 'Обратная связь BuildTop';
        $body = '';
        if (!empty($name)) {
            $body .= '<p><strong>Имя:</strong><br>' . $name . '</p>';
        }
        if (!empty($_POST['email'])) {
            $body .= '<p><strong>E-mail:</strong><br>' . $email. '</p>';
        }
        if (!empty($_POST['message'])) {
            $body .= '<p><strong>Сообщение:</strong><br>' . $user_message . '</p>';
        }
        $mail->Body =  $body;
        if (!$mail->send()) {
            $message = 'Возникла ошибка при отправке сообщения';
        } else {
            $message = 'Сообщение отправлено';
        }
        
        $response = ['message' => $message];
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
    }
}
