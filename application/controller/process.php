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
    function __construct()
    {
        parent::__construct();
        $this->postcards = $this->loadModel("postcards");
    }

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
        $mail->Host = "smtp.mail.yahoo.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "test.yangli@yahoo.com";
        $mail->Password = "testingbox";
        $mail->SetFrom("test.yangli@yahoo.com");
        $mail->Subject = "Postcard";
        //$mail->Body = "attached";
        $mail->Body = $_POST['message'];
        
        $image = $_POST['imgBase64'];
        $timestamp = time();
        $fileName = 'snap-'.strval($timestamp).'.png';       
        /* uploading image to the db */
        $success = $this->postcards->addPostcard($image, $fileName, $timestamp);
        if (!$success) {
            echo json_encode(array('success' => 0,
                    'msg' => "Image File not generated"));
            return;
        }
        
        try {
            $mail->AddAddress("zhouhao4093@gmail.com");//""test.yangli@yahoo.com");
            echo $this->postcards->imageFolder . $fileName;
            $mail->AddAttachment($this->postcards->imageFolder . $fileName, 'postcard.png');
            
            if ($mail->Send()) {
                echo json_encode(array('success' => 1, 'msg' => 'Post card has been sent to your mailbox'));
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
