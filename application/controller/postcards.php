<?php

/**
 * Class Postcards
 *
 */
class Postcards extends Controller
{ 
    function __construct()
    {
        parent::__construct();
        $this->postcards = $this->loadModel("postcards");
    }

    /**
     * PAGE: index
     * This method is the default page to show all postcards 
     */
    public function index()
    {
        $postcards = $this->postcards->getAllPostcards();
        
        $names = "";
        for ($i=0; $i < count($postcards); $i++) {
            if ($i == 0)
                $names = $postcards[$i]["name"];
            else
                $names = $names . ',' . $postcards[$i]["name"];
        }

       // load views. Put names in a hidden field for js to load images
        require APP . 'view/_templates/header.php';
        echo "<input type=\"hidden\" id=\"card_names\" value=\"" . $names . "\"/>";
        require APP . 'view/postcards/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
    * Action: rawImage
    * This method opens the image and sends it straight to the browser
    */
    public function rawImage()
    {
        if (isset($_GET['image'])) 
            readfile(APP . 'images/' . $_GET['image']);   
        exit();
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function deleteSong($song_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($song_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($song_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_songs = $this->model->getAmountOfSongs();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_songs;
    }
}
