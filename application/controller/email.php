<?php

/**
 * Class email
 */
class Email extends Controller
{
    /**
     * PAGE: email
     * This method handles what happens when you send a postcard
     */
    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/email/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function sendemail()
    {
        
        $to      = 'nancy.liyang@gmail.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: nancy.liyang@gmail.com' . "\r\n" .
            'Reply-To: nancy.liyang@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers);

    }
}

