 <?php
  
 /**
   * file-name: index.php
   * created-by: Mohit Dadu
   * description: it is the php file home page to display and add library cards.
   * date:03/02/2017
   */

  $pageTitle = "home";
  include_once 'header.php';

  // to connect the database
  include("./config/config.php");

  $msg="";

  // check for getting data from home page
  if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $records = $db->findCard('cardData', $id);

      if($records) {
          foreach ($records as $record) { 
              $name = $record->getField('studentName');
              $email = $record->getField('email');
              $phone = $record->getField('phoneNo');
          }
      } else {
          $msg = "No Record Found";
      }
  }
 
 // to save the updated student details
  if(isset($_POST['save'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];

      $records = $db->editRecord('cardData', $id, $name, $email, $phone);
      
      if($records){
        $msg = "Record Updated Successfully ";
      } else {
        $msg = "Failed to Update. Please Try Again....";
      }
  }

?>
<!-- Content Section -->
<nav class="navbar navbar-default col-md-12">
  <div class="row">
    <div class="col-md-3">
      <img src="./asset/images/logo.png" alt="logo" height="100px" width="120px">
    </div>
    <div class="col-md-7">
      <div class="container-fluid header text-center">
        <h1>Library Card Management Portal</h1>     
      </div>
    </div>
  </div>
</nav>
<div class="container">
  <ul class="nav nav-tabs">
    <li><a href="index.php"><span style="color: black";></span>Home</a></li>
    <li class="active"><a href="">Library Card</a></li>
  </ul>

  <!-- content section for Home Page -->
  <div class="tab-content">
      <!-- content section for Library card page -->
      <div id="libraryCard" class="tab-pane fade in active">
        <!--   content for library card  -->
        <!-- display and can edit details of library card -->
        <form method="post" action="">
          <div class="panel panel-default">
            <div class="panel-heading">Card Details</div>
            <dl class="dl-horizontal">
              <dt>Student Name</dt>
              <dd><input type="text" name="name" value="<?php echo $name; ?>" /></dd>
              <dt>Email Address</dt>
              <dd><input type="text" name="email" value="<?php echo $email; ?>" /></dd>
              <dt>Phone Number</dt>
              <dd><input type="text" name="phone" value="<?php echo $phone; ?>" /></dd>
            </dl>
            <input class="btn btn-primary btn-block" type= 'submit' name='save' id='save' value='save'>
            <span><?php echo $msg;?></span>
          </div>
        </form> 
        <div class="row">
        <div class="col-md-12">
          <div class="pull-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#add_book_modal">Add Book</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->

<!-- Modal - Add Books -->
<div class="modal fade" id="add_book_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Book Details</h4>
            </div>
            <div class="modal-body">
            <form  method="post" action=""  id="searchform"> 
              <input  type="text" name="search"> 
              <input  type="submit" name="search" id='search' value="Search">
            </form><br>
            <form method="post" action="">
              <div class="panel panel-default">
                <table  class="table table-striped table-bordered table-hover table-condensed">
                  <tr>
                    <th>BOOK ID</th>
                    <th>BOOK NAME</th>
                    <th>BOOK CATEGORY</th>
                    <th>ADD BOOK</th>
                  </tr>
                <?php

                  if(isset($_POST['search'])) {
                    $searchName = $_POST['search'];
                    $bookRecords = $db->findBook('bookData', $searchName);
                  } else { 
                    //Initializing the database connection
                    $bookRecords = $db->fetchData('bookData');
                  }

                  if($bookRecords) {
                    foreach ($bookRecords as $record) { 
                ?>
                    <tr>
                      <td><?php echo $record->getField('bookId'); ?></td>
                      <td><?php echo $record->getField('bookName'); ?></td>
                      <td><?php echo $record->getField('bookCategory'); ?></td>               
                      <td><input type="checkbox" name="checkbox" value=""/></td>
                    </tr>    
                  <?php       
                      }
                  }
                  ?>
                </table>
              </div>
            </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


<?php 
  // include footer
  include_once 'footer.php';
  ?>