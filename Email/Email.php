<?php

require_once ROOT_DIR . '/Email/SMTP.php';
require_once ROOT_DIR . '/Email/Templating.php';

class Email
{
    public static function verification($to, $data)
    {
        $subject = "Verify your email";
        $message = Template::build('VerifyEmail', $data);
        SMTP::send($to, $subject, $message);
    }
}
