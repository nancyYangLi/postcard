<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    /**
     * This method handles what happens when you choose an option to create a postcard
     */
    public function source()
    {
        // load views
        require APP . 'view/_templates/header.php';
        switch($_POST['imagesource']) {
            case 1:
                require APP . 'view/home/webcamera.php';
                break;
            case 2:
                require APP . 'view/home/imageupload.php';
                break;
            case 3:
                require APP . 'view/home/imagedragdrop.php';
                break;
        }
        require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: process
     * This method handles what happens when you process an image
     */
    public function imageprocess()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/imageprocess.php'; 
        require APP . 'view/_templates/footer.php';
    }
}
