<?php
    session_start();

/*
  file-name: addRecord.php
  used-for: script.js
  created-by: Mohit Dadu
  date: 06/02/2017
*/

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    // include Database connection file 
    include("./config/config.php");

    // get values 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // adding data to the card data 
    $db->addCard('cardData', $name, $email, $phone);
}

?>