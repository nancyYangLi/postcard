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
        $mail->AllowEmpty = true;
        $mail->Username = "test.yangli@yahoo.com";
        $mail->Password = "testingbox";
        $mail->SetFrom("test.yangli@yahoo.com");
        $mail->Subject = $_POST['emailName'];
        $mail->Body = $_POST['emailMsg'];
        
        $address = $_POST['emailTo'];
        $image = $_POST['imgBase64'];
        $timestamp = time();
        $fileName = 'snap-'.strval($timestamp).'.png';
        
        /* uploading image to the db */
        $id = $this->postcards->addPostcard($image, $fileName, $timestamp);
        if (!$id) {
            echo json_encode(array('success' => 0,
                    'msg' => "Failed to generate image file!"));
            return;
        }
        
        try {
            $mail->AddAddress($address);
            $mail->AddAttachment($this->postcards->imageFolder . $fileName, 'postcard.png');
            
            if ($mail->Send()) {
                echo json_encode(array('success' => 1, 'msg' => 'Postcard has been sent to the mailbox'));
            }
            else {            
                 // delete cards that are not sent by email
                $this->postcards->deletePostcard($id);
                echo json_encode(array('success' => 0,
                    'msg' => "Sending postcard failed"));
            }
        } catch (Exception $exc) {
            // delete cards that are not sent by email
            $this->postcards->deletePostcard($id);
            echo json_encode(array('success' => 0,
                'msg' => "Sending postcard failed: ". $exc->getMessage()));
        }
        
    }
}
