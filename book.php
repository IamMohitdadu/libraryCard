<?php

// for issuing book to the card
  if(isset($_POST['issueBook'])){
      if(!empty($_POST['check_list'])) {
          // Counting number of checked checkboxes.
          $checked_count = count($_POST['check_list']);
          echo "You have selected following ".$checked_count." option(s): <br/>";
          // Loop to store and display values of individual checked checkbox.
          foreach($_POST['check_list'] as $selected) {
          echo "<p>".$selected ."</p>";
          }
          echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";
      } else {
          echo "<b>Please Select Atleast One Option.</b>";
      }
  }



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
                      <td><input type="checkbox" name="check_list[]" value="<?php echo $record->getField('bookId');?>"/></td>
                    </tr>    
                  <?php       
                      }
                  }
                  ?>
