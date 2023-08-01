<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ROOT_DIR . '/Vendor/PHPMailer/src/Exception.php';
require ROOT_DIR . '/Vendor/PHPMailer/src/PHPMailer.php';
require ROOT_DIR . '/Vendor/PHPMailer/src/SMTP.php';

class SMTP
{
    private static function mailer()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = PRODUCTION;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PRODUCTION ? "tls" : "";
        $mail->Port = SMTP_PORT;
        $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
        $mail->isHTML(true);
        return $mail;
    }

    public static function send($to, $subject, $message)
    {
        try {
            $mail = self::mailer();
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);
            $mail->send();
        } catch (Exception $e) {
            throw new EmailException($e->getMessage(), 500);
        }
    }
}
