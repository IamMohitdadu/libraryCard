<?php
  /**
* Name: config.php
* Use For: Employee Management Portal
* Created By: Mohit Dadu
* Description: File containing all the data required for connecting the web application to the database.
*/

// connecting to the database class
require_once ('dbclass.php');
	
$database = 'libraryCard';
$host = '172.16.9.62';
$username = 'admin';
$password = 'Mohit@249d';

$db = new Database();
$db->initDB($database, $host, $username, $password);