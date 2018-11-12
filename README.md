# Postcard Creator

I choose the "Postcard Creator" to develop because it is an interesting and simple-to use PHP MVC web application. I have worked on everything from front-end HTML, CSS, JavaScript and AJAX to the server side code(PHP) and database(SQLite). It has been a wonderful experience creating various postcards for my sweet love newborn twins!
 

### Steps

  - Upload an image via web camera, file upload, or drag & drop
  - Modify the image to contain a message, customize the style of the message
  - Write an optional name, message and the recipient 
  - Send an email containing the postcard as an attachment
  - View the history of previously sent postcards in carousel
  
### Demo
[https://postcardcreator.github.com](https://www.google.com)

### Service Pack

* [XAMPP]- a free and open-source cross-platform web server solution stack package 
* [SQLite] - a relational database management system contained in a C programming library
* [MINI](https://github.com/panique/mini) - a simple naked PHP application

### Libraries

* [jQuery] - a fast, small, and feature-rich JavaScript library
* [Bootstrap] -  a free and open-source front-end framework for designing websites and web applications
* [Slick] - a carousel 

### Design decisions
This web application has two sections. The first section is to enable the user to create their own postcards. It includes Home page, the webcamera page, fileupload page, imagedragdrop page and the process page. The second section is used to display previously ceated postcards. It has postcards page.

The Home page provides three options as the image source to create post card. They are Web Camera, Upload File and Drag and Drop Image. It will redirect to a certain page based on the form selections. 

By embedding a video element in the webcamera page, the camera will be opened automatically. If the user click the Snapshot button, a snapshot will be displayed in the canvas below.

The fileupload page allows the user to choose an image type only file and preview the file.

The imagedragdrop page enable the user to drag & drop an image and previwe the image.

No matter what image source option is selected, it will redirect to the same process page. User can add message, customize the style of message and send it as an attachment.

It is a MVC PHP web application...unfinished


### Tests

Open your favorite Terminal and run these commands.

First Tab:
```sh
$ node app
```

Second Tab:
```sh
$ gulp watch
```

(optional) Third:
```sh
$ karma test
```
### Troubleshooting & FAQ
 - Enable SSL
 - Change the permission of image folder and db folder


### Todos

 - Write MORE Tests
 - Add Night Mode
 - 
 

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [XAMPP]: <https://www.apachefriends.org/download.html>
   [SQLite]: <https://www.sqlite.org/download.html>
   [jQuery]: <https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js>
   [Bootstrap]: <https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css>
   [Slick]: <https://github.com/kenwheeler/slick/>
