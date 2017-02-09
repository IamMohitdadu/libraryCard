<?php

/**
* file-name: deleteIssuedBook.php
* used for: libraryCard.php
* created-by: Mohit Dadu
* description: it is the php file to delete the Issued Book from the record.
* date:06/02/2017
*/

header('Content_Type:text/xml');

include("./config/config.php");

$id = $_GET['id'];
$db->deleteIssuedBook($id);
header('Location: libraryCard.php?id=26');
