<?php

/**
 * Class source
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Source extends Controller
{
    /**
     * PAGE: webcamera
     * This method handles what happens when you choose to take an image from webcamera
     */
    public function webcamera()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/source/webcamera.php';
        require APP . 'view/_templates/footer.php';
    }
    
    
    /**
     * PAGE: fileupload
     * This method handles what happens when you choose to upload an image
     */
    public function fileupload()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/source/imageupload.php';
        require APP . 'view/_templates/footer.php';
    }
    
    
    /**
     * PAGE: imagedrapdrop
     * This method handles what happens when you choose to drag and drop an image
     */
    public function imagedragdrop()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/source/imagedragdrop.php';
        require APP . 'view/_templates/footer.php';
    }
    
    
    /**
     * Ajax action: upload
     * This method saves a Base64 encoded canvas image to a png file
     */
    public function upload()
    {
        define('UPLOAD_DIR', APP . 'images/');

        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $file = UPLOAD_DIR . 'current-snap.png';
        $success = file_put_contents($file, $data);
        print $success ? TRUE : FALSE;
    }
}
