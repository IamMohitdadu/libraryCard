<?php

/**
* file-name: delete.php
* used for: index.php
* created-by: Mohit Dadu
* description: it is the php file to delete the records.
* date:06/02/2017
*/

include("./config/config.php");

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$db->deleteCard($id);
}