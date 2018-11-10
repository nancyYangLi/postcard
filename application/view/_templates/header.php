<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Postcard Creator</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: If the JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->
    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>slick/slick-theme.css"/>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    
</head>
<body>
    <!-- logo -->
    <!--
    <div class="logo">
        POSTCARD CREATOR
    </div>
    -->

    <!-- navigation -->
 
    <div class="navigation">
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>postcards">Your Postcards</a>
        <!--  
        <a href="<?php echo URL; ?>home/webcamera">webcamera</a>
        <a href="<?php echo URL; ?>home/exampletwo">subpage 2</a>
        -->
        
    </div>
    
