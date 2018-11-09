<?php

/**
 * Class process
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once APP . 'libs/PHPMailer/src/PHPMailer.php';
require_once APP . 'libs/PHPMailer/src/SMTP.php';
require_once APP . 'libs/PHPMailer/src/Exception.php';

class Process extends Controller
{
    /**
     * PAGE: process
     * This method handles what happens when you process an image
     */
    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/process/index.php'; 
        require APP . 'view/_templates/footer.php';
    }

    public function loadImage()
    { 
        // todo: error handling
        if (isset($_POST['image'])) {
            $path = APP . '/images/' . $_POST['image'];
            $file = file_get_contents($path);
            if ($file) {
                echo base64_encode($file);
                return;
            }
        }
        http_response_code(404); 
    } 
    
    public function sendEmail()
    {
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "nancy.liyang@gmail.com";
        $mail->Password = "88288710Ly";
        $mail->SetFrom("nancy.liyang@gmail.com");
        $mail->Subject = "Test";
        $mail->Body = "hello";
        
        define('UPLOAD_DIR', APP . 'images/');
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        
        $file = UPLOAD_DIR . 'snap-' . strval(time()) . '.png';
        $success = file_put_contents($file, $data);
        
        try {
            $mail->AddAddress("nancy.liyang@gmail.com");
            $mail->AddAttachment($file, 'postcard.png');
            
            if ($mail->Send()) {
                echo json_encode(array('success' => 1, 'msg' => ''));
            }
            else {
                echo json_encode(array('success' => 0,
                    'msg' => "Mail not sent"));
            }
        } catch (Exception $exc) {
            echo json_encode(array('success' => 0,
                'msg' => "Mail not sent: ". $exc->getMessage()));
        }
        
    }
}
