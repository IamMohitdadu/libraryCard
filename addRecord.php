<?php

/*
  file-name: saddRecord.php
  used-for: script.js
  created-by: Mohit Dadu
  date: 06/02/2017
*/

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']))
    {
        // include Database connection file 
        include("./config/config.php");
 
        // get values 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $db->addCard('cardData', $name, $email, $phone);
    }
?>