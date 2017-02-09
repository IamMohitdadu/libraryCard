<?php

/**
   * file-name: searchBook.php
   * ussed for: script.js
   * created-by: Mohit Dadu
   * description: it is the php file to display the searched books.
   * date:09/02/2017
   */

// to connect to the database and create database object
include("./config/config.php");

if(isset($_GET['name']))
{
  $name = $_GET['name'];
  $bookRecords = $db->searchBook($name);
} else { 
  //Initializing the database connection
  $bookRecords = $db->fetchData('bookData');
}

if($bookRecords){

?>

  <div class="panel panel-default"><br>
    <table  class="table table-striped table-bordered table-hover table-condensed">
      <tr>
        <th>BOOK ID</th>
        <th>BOOK NAME</th>
        <th>BOOK CATEGORY</th>
        <th>ADD BOOK</th>
      </tr>
    <?php
      foreach ($bookRecords as $record) { 
    ?>
      <tr>
        <td><?php echo $record->getField('bookId'); ?></td>
        <td><?php echo $record->getField('bookName'); ?></td>
        <td><?php echo $record->getField('bookCategory'); ?></td>               
        <td><input type="checkbox" name="check_list[]" value="<?php echo $record->getField('bookId');?>"/></td>
      </tr>    
      <?php       
          }
      ?>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <input type="submit" class="btn btn-primary" name="issueBook" value="Issue Book">
  </div>
<?php
} else {
  echo '<span style="background-color: white">Sorry No book Available</span>';
}
?>
