<?php
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']))
    {
        // include Database connection file 
        include("./config/config.php");
 
        // get values 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $db->addCard('cardData', $name, $email, $phone);
    }
?>