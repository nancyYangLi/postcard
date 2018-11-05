<?php

/**
 * Class webcamera
 *
 */
class Webcamera extends Controller
{
    
    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function updateImage()
    {
        
        echo 'Doing two things. One is to send the image, the other is to add the imge into database';
        
        echo'<br/><br/>';
        echo 'this is the image data';
        echo $_POST['imageData'];
    }
    
}
