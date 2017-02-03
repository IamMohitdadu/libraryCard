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

  // find the associate layout
  $request = $fm->newFindAllCommand('cardData');

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="asset/vendors/js/bootstrap.js"></script>

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
    <li class="active"><a href="#home">Home</a></li>
    <li><a href="#libraryCard">Library Card</a></li>
  </ul>

  <!-- content section for Home Page -->
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Card</button>
            </div>
        </div>
      </div>

      <!-- To display and add new cards -->
      <div class="panel panel-default">
        <div class="panel-heading">Card Details</div>
        <div class="panel-body"></div>
        <table  class="table table-striped table-bordered table-hover table-condensed">
          <tr>
            <th>CARD ID</th>
            <th>NAME</th>
            <th colspan="3"><center>Action</center></th>
          </tr>

          <?php
            
            $result = $request->execute();
            $records = $result->getRecords();
            
        // Loop through the associate records 
            if (FileMaker::isError($records)) {
                echo $records->getMessage();
                if (! isset($result->code) || strlen(trim($result->code)) < 1) {
                    echo 'A System Error Occured';
                } else {
                    echo 'No Records Found (Error Code: '.$result->code.')';
                }
            } else {
                foreach ($records as $record) {
        ?>
            
            <tr>
              <td><?php echo $record->getField('cardId'); ?></td>
              <td><?php echo $record->getField('studentName'); ?></td>
              <td><a href="view.php?id=<?php echo $record->getField('Id'); ?>">
                <span class="glyphicon glyphicon-eye-open"></span>&nbsp;VIEW</a></td>   
              <td><a href="edit.php?id=<?php echo $record->getField('Id'); ?>">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;EDIT</a></td>
              <td><a href="delete.php?id=<?php echo $record->getField('rec_id'); ?>">
                <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;DELETE</a></td>
            </tr>
                
        <?php       
            }
        }
        ?>

        </table>
      </div>
    </div>

    <!-- content section for Library card page -->
    <div id="libraryCard" class="tab-pane fade">
      
    </div>
  </div>
</div>




<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>



<!-- /Content Section -->



<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Card</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="Last Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="Email Address" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Phone Number</label>
                    <input type="number" id="email" placeholder="Phone Number" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_first_name">First Name</label>
                    <input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_last_name">Last Name</label>
                    <input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_email">Email Address</label>
                    <input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<?php 
  // include footer
  include_once 'footer.php';
  ?>
