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
        switch ($_POST['imagesource']) {
        case 1: 
            header('Location: /postcard/source/webcamera'); 
            break;
        case 2:
            header('Location: /postcard/source/fileupload'); 
            break;
        case 3:
            header('Location: /postcard/source/imagedragdrop');
            break;
        }
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
