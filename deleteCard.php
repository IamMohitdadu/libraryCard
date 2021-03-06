<?php

/**
* file-name: delete.php
* used for: index.php
* created-by: Mohit Dadu
* description: it is the php file to delete the records.
* date:06/02/2017
*/

// including the config file for creating database class object.
include("./config/config.php");

// checking for receving Id from index page to delete record from database
if (isset($_GET['id'])) {
	$id = $_GET['id'];
    
    // creating object for Database class defined in dbclass.php
    $db = new Database();

    // initializing the variables into the database class
    $db->initDB($database, $host, $username, $password);
	
	// checking and deleting data through classes 
	$db->deleteCard($id);
	header("Location: index.php");
}