<?php
  
/**
* file-name: index.php
* created-by: Mohit Dadu
* description: it is the php file home page to display and add library cards.
* date:03/02/2017
*/

$pageTitle = "home";
include_once './include/header.php';

// to connect the database
include("./config/config.php");

$msg = "";

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
        $errmsg = "No Record Found";
    }
}

// to save the updated student details
if(isset($_POST['save'])) {
    $err = true;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone = filter_var($phone, FILTER_VALIDATE_INT);
    
    // Validate e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $err = false;
    } else {
        $err = true;
        $msg = "please enter valid email address";
    }
    
    // validate phone number
    if ($phone && strlen($phone) === 10) {
        $err = false;
    } else {
        $err = true;
        $msg = "please enter 10 digit mobile number. Don't include +91/0";
    }
    
    if (!$err) {
      $records = $db->editRecord('cardData', $id, $name, $email, $phone);
      
      if($records){
          $msg = "Record Updated Successfully ";
      } else {
          $msg = "Failed to Update. Please Try Again....";
      }
    }
}

// for issuing book to the card
if(isset($_POST['issueBook'])) {
    if(!empty($_POST['check_list'])) {
        // Counting number of checked checkboxes.
        $checked_count = count($_POST['check_list']);
        if ($checked_count <= 4) {
              // Loop to store and display values of individual checked checkbox.
            foreach($_POST['check_list'] as $selectedBook) {
                $records = $db->issueBook('cardBook', $id, $selectedBook);
            }
            if($records) {
                $msg = $checked_count." Books Issued ";
            } else {
                $msg = "Failed to Update. Please Try Again....";
            }
        } else {
          $msg = "You exceded the issued limits. please add maximum four books.";
        }
    } 
}
?>

<!-- Content Section -->
<nav class="navbar navbar-default col-md-12">
  <div class="row">
    <div class="col-md-3">
      <img src="./asset/css/image/logo.png" alt="logo" height="100px" width="120px">
    </div>
    <div class="col-md-7">
      <div class="container-fluid header text-center">
        <h1>Library Card Management Portal</h1>     
      </div>
    </div>
  </div>
</nav>
<div class="container">
  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="">Library Card</a></li>      
  </ol>
  <!-- content section for Library card page -->
  <div class="container col-md-12">

    <!-- content section for student card details and can edit details.  -->
    <div class="row">
      <div class="col-md-6">
        <form method="post" action="">
          <div class="panel panel-default">
            <div class="panel-heading">Card Details</div><br>
            <dl class="dl-horizontal">
              <dt>Student Name</dt>
              <dd><input type="text" name="name" value="<?php echo $name; ?>" /></dd><br>
              <dt>Email Address</dt>
              <dd><input type="text" name="email" value="<?php echo $email; ?>" /></dd><br>
              <dt>Phone Number</dt>
              <dd><input type="text" name="phone" value="<?php echo $phone; ?>" /></dd><br>
            </dl>
            <input class="btn btn-primary btn-block" type='submit' name='save' id='save' value='save'>
          </div>
        </form> 
      </div>
      <div class="well well-sm col-md-4">
        <button class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#add_book_modal">
          Issue Books</button>
        <div class="col-md-12">
          <span><strong><?php echo $msg;?></strong></span>
        </div>
      </div>
    </div>

   <?php
      //Initializing the database connection
      $records = $db->findCard('cardBook', $id);
      $countBook = 0;
      if($records) {
    ?>

    <!-- content section for issued book to the student.  -->
    <div class="panel panel-default" id="issued_book">
      <div class="panel-heading">Issued Books</div>
      <table  class="table table-striped table-bordered table-hover table-condensed">
        <tr class="info">
          <th>BOOK ID</th>
          <th>BOOK NAME</th>
          <th>BOOK CATEGORY</th>
          <th>RETURN BOOK</th>
        </tr>
        <?php
            foreach ($records as $record) { 
                $bookRecords = $record->getRelatedSet('bookData');
                if (FileMaker::isError($bookRecords)) {
                } else { 
                    foreach ($bookRecords as $bookRecord) {
                        $bookId = $bookRecord->getField('bookData::bookId');
        ?>

        <tr>
          <td><?php echo $bookRecord->getField('bookData::bookId'); ?></td>
          <td><?php echo $bookRecord->getField('bookData::bookName'); ?></td>
          <td><?php echo $bookRecord->getField('bookData::bookCategory'); ?></td>
          <td><a onclick='javascript:confirmationDelete($(this)); return false;'
            href="deleteIssuedBook.php?id=<?php echo $record->getRecordId(); ?>&cardId=<?php echo $id;?>">
            <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Return Book</a></td>   
        </tr>

        <?php  
                   }
                }     
                $countBook++;
            }
        } else { 
            echo "<span class='well'> No Book Issued Yet.</span>";
        }
        ?>

      </table>
    </div>
  </div>
</div>
<!-- /Content Section -->

<!-- Bootstrap Modals -->
<!-- Search, filter and issue Books to the student  -->
<div class="modal fade" id="add_book_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Book Details</h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="" > 
          <div class="panel panel-default">
            <div class="well col-md-12">
              <div class="col-md-5">
                <div class="col-md-12">
                  <label>Search through Name:</label>
                </div>
                <div class="input-group col-md-12">
                  <span class="input-group-addon glyphicon glyphicon-search"></span>
                  <input type="text" class="form-control search" id="myInput" placeholder="Search Book Names.." >
                </div>
              </div>
              <label class="col-md-2">OR</label>
              <div class="col-md-5">
                <div class="col-md-12">
                  <label>Through Category</label>
                </div>
                <div class="col-md-12">
                  <select id="select_field" class="form-control">
                    <option value="All" selected>All</option>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                    <option value="Math">Math</option>
                    <option value="Geography">Geography</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                  </select>
                </div>
              </div>
            </div>
            <table  class="table table-striped table-bordered table-hover table-condensed" id="myTable">
              <tr class="info">
                <th>BOOK ID</th>
                <th>BOOK NAME</th>
                <th>BOOK CATEGORY</th>
                <th>ADD BOOK</th>
              </tr>

              <?php

                //Initializing the database connection
                $bookRecords = $db->fetchData('bookData');
                if($bookRecords) {
                  foreach ($bookRecords as $record) { 
              ?>

              <tr category="<?php echo $record->getField('bookCategory'); ?>">
                <td><?php echo $record->getField('bookId'); ?></td>
                <td><?php echo $record->getField('bookName'); ?></td>
                <td><?php echo $record->getField('bookCategory'); ?></td>               
                <td><input type="checkbox" name="check_list[]" value="<?php echo $record->getField('bookId');?>"/></td>
              </tr> 

              <?php       
                  }
                } 
              ?>

            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" name="issueBook" value="Issue Book">
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<!-- // Modal -->

<?php 
  // include footer
  include_once './include/footer.php';
?>