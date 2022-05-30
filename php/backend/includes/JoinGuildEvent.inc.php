<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $eventId = $_POST["joinSelectedEventId"];
    $characterId = $_POST["joinCharacterId"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/JoinGuildEvent.class.php';
    include '../classes/JoinGuildEvent-contr.class.php';
    
    $joinGuildEvent = new JoinGuildEventContr($idUser, $eventId, $characterId);

    //ErrorHandlers and user login
    $joinGuildEvent->joinGuildEvent();

    //If Login success
    $res = "success";
    echo $res;
}

?>