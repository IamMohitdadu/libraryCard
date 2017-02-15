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

    // adding data to the cardData table into the database. 
    $db->addCard('cardData', $_POST['name'], $_POST['email'], $_POST['phone']);
}

?>