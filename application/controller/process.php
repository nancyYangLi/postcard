<?php

/**
 * Class process
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
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
}
