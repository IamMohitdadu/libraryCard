<?php
  /**
    * Name: config.php
    * Use For: Employee Management Portal
    * Created By: Mohit Dadu
    * Description: File containing all the data required for connecting the web application to the database.
    */
	
	// connecting to the Filemaker Api
    require_once ('filemakerapi/FileMaker.php');
		
    // Database details of the website
    $database = 'libraryCard';
    $host = '172.16.9.62';
    $username = 'admin';
    $password = 'Mohit@249d';
	
    $fm = new FileMaker($database, $host, $username, $password);