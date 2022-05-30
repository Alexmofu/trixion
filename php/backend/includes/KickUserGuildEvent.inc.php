<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $eventId = $_POST["eventId"];
    $characterId = $_POST["characterId"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/KickUserGuildEvent.class.php';
    include '../classes/KickUserGuildEvent-contr.class.php';
    
    $kickGuildEvent = new KickUserGuildEventContr($idUser, $eventId, $characterId);

    //ErrorHandlers and user login
    $kickGuildEvent->kickGuildEvent();

    //If Login success
    $res = "success";
    echo $res;
}

?>