<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $eventId = $_POST["joinSelectedEventId"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/LeaveGuildEvent.class.php';
    include '../classes/LeaveGuildEvent-contr.class.php';
    
    $leaveGuildEvent = new LeaveGuildEventContr($idUser, $eventId);

    //ErrorHandlers and user login
    $leaveGuildEvent->leaveGuildEvent();

    //If Login success
    $res = "success";
    echo $res;
}

?>