<?php

/**
* file-name: deleteIssuedBook.php
* used for: libraryCard.php
* created-by: Mohit Dadu
* description: it is the php file to delete the Issued Book from the record.
* date:06/02/2017
*/

// including the config file for creating database class object.
include("./config/config.php");

// receving cardBook Id and cardId from library page to delete record from database
$id = $_GET['id'];
$cardId = $_GET['cardId'];
$db->deleteIssuedBook($id);
header('Location: libraryCard.php?id='.$cardId);
