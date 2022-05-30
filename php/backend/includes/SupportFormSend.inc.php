<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $username = $_POST["supportusername"];
    $email = $_POST["supportemail"];
    $subject = $_POST["supportsubject"];
    $message = $_POST["supportTextarea"];
    
    

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/SupportFormSend.class.php';
    include '../classes/SupportFormSend-contr.class.php';
    
    $supportTicket = new SupportFormSendContr($username, $email, $subject, $message);

    //ErrorHandlers and user login
    $supportTicket->newSupportTicket();

    //If Login success
    $response = "success";
    echo $response;
}

?>