<?php 
/*
 * file-name: header.php
 * created-by: Mohit Dadu
 * description: it is the php header file used for all the web pages.
 * date:03/02/2017
 */
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Title for web page -->
      <title><?php echo isset($pageTitle) ? $pageTitle : "Library Card"?></title>

      <!-- Custom CSS File   -->
      <link rel="stylesheet" type="text/css" href="./asset/css/styles.css"/> 


      <!-- Bootstrap CSS File  -->
      <link rel="stylesheet" type="text/css" href="./asset/vendors/css/bootstrap.css"/>

    </head>
    <body>
    
