<?php

/**
 * Class Home
 * 
 */
class UnitTest extends Controller
{    
    function __construct()
    {
        parent::__construct();
        $this->postcards = $this->loadModel("postcards");
    }

    /**
     * list: show all records in database and check existance of image files 
     * Url: https://localhost/postcard/unitTest/list     
     */
    public function list()
    {
        $cards = $this->postcards->getAllPostcards();
        foreach ($cards as $c) {
            print_r($c);
            echo "<br>";
            $path = APP . 'images/' . $c["name"];
            if (!file_exists($path)) {
                print_r("Image file " . $path . "does NOT exit");
                echo "<br>";
            }
        }
    }

    /*
     * add: get one image in database by id. 
     * Url: https://localhost/postcard/unitTest/find?id=ID     
     */
    public function find()
    {
        $id = $_GET["id"];
        $card = $this->postcards->getPostcard($id);
        if (empty($card)) {
            echo "card #" . strval($id) ." is not found";
            exit;
        }
        print_r($card);
        $path = APP . 'images/' . $card["name"];
        echo "<br>";
        if (!file_exists($path)) {
            print_r("Image file " . $path . "does NOT exit");
            echo "<br>";
        }
        else {
            echo "<img src=\"https://localhost/postcard/postcards/rawImage?image=" . $card["name"] . "\">";
        }
    }

    /*
     * add: use model api to add a image to database. 
     * Url: https://localhost/postcard/unitTest/add?img_src=URL-ENCODED-IMAGE-URL
     *      URL-ENCODED-IMAGE-URL can be got using online encoder such as
            https://www.urlencoder.org
     */
    public function add()
    {
        $url = $_GET["img_src"];
        $image = file_get_contents($url);
        if (!$image) {
            echo "Failed to get image from url: " . $url;
            exit;
        }
        $image = "data:image/png;base64,".base64_encode($image);
        $time = time();    
        $name = "ut-" . strval($time) . "png";

        $result = $this->postcards->addPostcard($image, $name, $time);
    
        if (!$result)
            echo "Adding failed";
        else
            echo "Image has been added, prime key is " . strval($result);
    }
    
    /* 
     * delete a image from database and image folder
     * Url: https://localhost/postcard/unitTest/delete?id=ID     
     */
    public function delete()
    {
        $id = $_GET["id"];
        $result = $this->postcards->deletePostcard($id);
        if (!$result)
            echo "Deleting falied";
        else
            echo "Image Deleted";
    }   
}

