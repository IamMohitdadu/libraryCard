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
<div class="container ">
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>    
  </ol>

  <!-- content section for Home Page -->

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

      <!-- To display model for adding new card -->
      <div class="row">
        <div class="col-md-12">
          <div class="pull-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Card</button>
          </div>
        </div>
      </div>

      <!-- To display student cards -->
      <div class="panel panel-default">
        <div class="panel-heading">Card Details</div>
        <table  class="table table-striped table-bordered table-hover table-condensed">
          <tr>
            <th>CARD ID</th>
            <th>NAME</th>
            <th>EMAIL ADDRESS</th>
            <th>PHONE NUMBER</th>
            <th colspan="3"><center>Action</center></th>
          </tr>
        <?php

          //Initializing the database connection
          $records = $db->fetchData('cardData');

          if($records) {
            foreach ($records as $record) { 
        ?>
            <tr>
              <td><?php echo $record->getField('cardId'); ?></td>
              <td><?php echo $record->getField('studentName'); ?></td>
              <td><?php echo $record->getField('email'); ?></td>
              <td><?php echo $record->getField('phoneNo'); ?></td>
              
              <td><a href="libraryCard.php?id=<?php echo $record->getField('cardId'); ?>">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;EDIT</a></td>
              <td><a href="deleteCard.php?id=<?php echo $record->getRecordId(); ?>">
                <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;DELETE</a></td>
            </tr>
                
          <?php       
              }
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->
<!-- Modal - Add New card -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Card</h4>
            </div>

            <form method="post" action="">
              <div class="modal-body">
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" id="name" placeholder="Student Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="Email Address" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" id="phone" placeholder="Phone Number" class="form-control"/>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <!-- addRecord method defined in script.js file -->
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
              </div>
            </form>
        </div>
    </div>
</div>
<!-- // Modal -->


<?php 
  // include footer
  include_once 'footer.php';
  ?>