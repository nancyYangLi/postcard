# Postcard Creator

The "Postcard Creator" is a simple-to-use and cross browser friendly PHP MVC web application. I have worked on everything from front-end HTML, CSS, JavaScript and AJAX to the server side code(PHP) and database(SQLite). It has been a wonderful experience creating various postcards for my sweet love newborn twins!
 
### Service Pack

* [Apache]- a free and open-source cross-platform web server solution stack package 
* [SQLite] - a relational database management system contained in a C programming library

### Setup

To successfully run the demo, complete the following steps:

  * Unzip the files from postcard.zip See [Folder Structure](#folder-structure)
  * Place the top directory postcard and its content in the `DOCUMENT_ROOT` of Apache server
  * Make sure the user whom the Apache is running as has the `Read & Write` previlidges on 
     postcard/application/images, postcard/db and postcard/db/postcard.db

### Usage

  * After setting up, user can access to the application via [https://DEPLOY-SITE/postcard]. In the XAMPP environment in which this web application is developed, the URL is [https://localhost/postcard]. Please note that it has to be `https` for the user to access the camera in the application.
  * User can choose a way to get the image in order to make a postcard: capturing an image via web camera, uploading an image file or drag & drop an image file.
  * After the user decides to use a certain image to make a postcard, he/she will be brougt to the process page where the user can modify the image to contain a message and customize the style of the message
  * User can send the postcard as an attachment to the recipient with optional name and message.
  * A history of previously sent postcards can be shown in carousel. User can access to the history via Postcards in the navigation bar.

### Trouble shooting

  * `SSL Error “Your Connection is Not Secure” `
    It happens when the Secure Website Certificate on a https site cannot be validated on the web browser. 
     * **Chrome**: To allow insecure localhost, copy `chrome://flags/#allow-insecure-localhost` to the address bar, and enable the first item "Allow invalid certificates for resources loaded from localhost".
     * **Firefox**: On the warning page, click Advanced; Click Add Exception…; On the Add Security Exception dialog confirm adding exception.
  * `Pop-up box “Failed to generate postcard” `
     When sending a postcard by email, user might get this warning. Please make sure the last step in [Setup](#Setup) section has been carried out.
     
### Unit Tests
* Display all postcards and check existance of image files
```
Url: https://localhost/postcard/unitTest/list     
```

```
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
```

* Get one image in database by id
```
Url: https://localhost/postcard/unitTest/find?id=ID      
```

```
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
```

* Use model API to add an image to database
```
Url: https://localhost/postcard/unitTest/add?img_src=URL-ENCODED-IMAGE-URL
```

`URL-ENCODED-IMAGE-URL` can be got using online encoder such as https://www.urlencoder.org

```
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
```

* delete an image from database and image folder
```
Url: https://localhost/postcard/unitTest/delete?id=ID    
```

```
public function delete()
    {
        $id = $_GET["id"];
        $result = $this->postcards->deletePostcard($id);
        if (!$result)
            echo "Deleting falied";
        else
            echo "Image Deleted";
    }   
```
### Design decisions
This web application has two sections. The first section is to enable the user to create their own postcards.
It includes Home page, the webcamera page, fileupload page, imagedragdrop page and the process page. The second section is used to display previously ceated postcards. It has postcards page.

The `Home` page provides three options as the image source to create post card, namely Web Camera, Upload File and Drag and Drop Image. It will redirect to a certain page based on the form selection. 

By embedding a video element in the `webcamera` page, the camera will be opened automatically. If the user click the Snapshot button, a snapshot will be displayed in the canvas below.

The `fileupload` page allows the user to choose an image type only file and preview the file.

The `dragdrop` page enable the user to drag & drop an image and previwe the image.

No matter what image source option is selected, it will redirect to the same `process` page once user decide to use the image for the postcard. On process page user can add message, customize the style of message and send it as an attachment in an email.

### MVC Architecture
This application is developed in a MVC framework "panique/mini". The controllers and models are developed in PHP while the views are developed with Html5/Javascript.

  * Model: Postcards
     In Postcards, Create, Read and Delete actions are implemented. Once a postcard is created it won't be changed, thus Update action is not implemented.

  * Controler: Home, Source, Process and Postcards
     `Home`: the home page
     `Source`: three actions are implemented: webcamera, upload and drag & drop
     `Process`: index action is for the text editing on image; sendEmail is an ajax action for email sending; loadImage is an ajax action to get an image file in a MVC architecture;
     `Problem`: the error page when no controler/action is found by router.
     `unitTest`: to test the model "Postcards"
  `View`: Each action, except Ajax action, has a view page.

### Folder Structrue
```bash
postcard
|____application
| |____config
| |____controller
| |____core
| |____images
| |____libs
| | |____PHPMailer
| |____model
| |____view
| | |_____templates
| | |____home
| | |____postcards
| | |____problem
| | |____process
| | |____source
|____db
|____public
| |____css
| |____img
| |____js
| |____slick
```

### Libraries

* [jQuery] - a fast, small, and feature-rich JavaScript library
* [Bootstrap] -  a free and open-source front-end framework for designing websites and web applications
* [panique/mini] - An extremely simple naked PHP application. MIT license. <https://github.com/panique/mini>
* [Slick] - A carousel using CSS & Js. MIT license. <https://github.com/kenwheeler/slick/>
