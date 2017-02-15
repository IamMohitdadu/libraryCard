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

    // creating object for Database class defined in dbclass.php
	$db = new Database();

	// initializing the variables into the database class
	$db->initDB($database, $host, $username, $password);

    // adding data to the cardData table into the database. 
    $db->addCard('cardData', $_POST['name'], $_POST['email'], $_POST['phone']);
}

?>