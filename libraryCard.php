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
 
if(isset($_POST['submit']))
{
  $id = $_POST['id'];
  $records = $db->findData('cardData', $id);

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
    <li class="active"><a href="libraryCard.php">Library Card</a></li>
  </ul>

  <!-- content section for Home Page -->
  <div class="tab-content">
      <!-- content section for Library card page -->
      <div id="libraryCard" class="tab-pane fade in active">
        <!--   content for library card  -->
        <form  method="post" action=""  id="searchform"> 
          <input  type="text" name="id"> 
          <input  type="submit" name="submit" id='submit' value="Search">
          
          <?php 
                if($records) {
                    foreach ($records as $record) { 
                        $cardId = $record->getField('cardId');
                        $name = $record->getField('studentName');
                        $email = $record->getField('email');
                        $phone = $record->getField('phoneNo');
                    }
                } else {
                  echo "No Record Found";
                }
           ?>

        </form>
        <div class="panel panel-default">
          <div class="panel-heading">Card Details</div>
            <dl class="dl-horizontal">
              <dt>Student ID</dt>
              <dd><?php echo $cardId; ?></dd>
              <dt>Student Name</dt>
              <dd><?php echo $name; ?></dd>
              <dt>Email Address</dt>
              <dd><?php echo $email; ?></dd>
              <dt>Phone Number</dt>
              <dd><?php echo $phone; ?></dd>
            </dl>
        </div>
        
    </div>
  </div>
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->

<!-- Modal - View card details -->


<div class="modal fade" id="view_card_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Student Details</h4>
            </div>
            <?php if(isset($_GET['id'])){
                $id = $_GET['id'];
                $records = $db->findData($id);
                if($records) {
                    foreach ($records as $record) { 
                        $cardId = $record->getField('cardId');
                        $name = $record->getField('studentName');
                        $email = $record->getField('email');
                        $phone = $record->getField('phone');
                    }
                }
            } ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="first_name">cardId</label><?php echo $id; ?>
                   <!-- <input type="text" id="first_name" placeholder="First Name" class="form-control" value="<?php echo $cardId; ?>"/>  -->
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
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


<?php 
  // include footer
  include_once 'footer.php';
  ?>