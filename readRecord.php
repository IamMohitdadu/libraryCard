<?php

/*
  file-name: readRecord.php
  used-for: script.js
  created-by: Mohit Dadu
  date: 06/02/2017
*/


// include Database connection file 
include("./config/config.php");

// Design initial table header 
$data ="<table  class='table table-striped table-bordered table-hover table-condensed'>
          <tr>
            <th>S.No.</th>
            <th>CARD ID</th>
            <th>NAME</th>
            <th>EMAIL ADDRESS</th>
            <th>PHONE NUMBER</th>
            <th colspan='3'><center>Action</center></th>
          </tr>";

//Initializing the database connection
$records = $db->fetchData('cardData');

// if query results contains rows then fetch those rows
if($records) {
    $number = 1;
    foreach ($records as $record) {
        $data .= "<tr>
          <td>" echo $number "</td>
          <td>" echo $record->getField('cardId'); "</td>
          <td>" echo $record->getField('studentName'); "</td>
          <td>" echo $record->getField('email'); "</td>
          <td>" echo $record->getField('phoneNo'); "</td>
          <td><button class='btn btn-success' data-toggle='modal' data-target='#view_card_modal' 
                id=" echo $record->getRecordId(); ">
                <span class='glyphicon glyphicon-eye-open'></span>&nbsp;VIEW </button></td>
          <td><a href='#?id="echo $record->getRecordId();">
            <span class='glyphicon glyphicon-eye-open'></span>&nbsp;VIEW</a></td>   
          <td><a href='edit.php?id=" echo $record->getField('Id'); ">
            <span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;EDIT</a></td>
          <td><a href='delete.php?id=" echo $record->getRecordId(); ">
            <span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;DELETE</a></td>
        </tr>";
        $number++;
    }
} else {
    // records now found 
    $data .= "<tr><td colspan='6'>Records not found!</td></tr>";
}

$data .= "</table>";

echo $data;
?>