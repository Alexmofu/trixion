<?php
session_start();
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if(isset($_POST)){
    // Grab data
    $idUser = $_SESSION["id_user"];
    $eventName = $_POST["newEventName"];
    $eventType = $_POST["newEventType"];
    $eventShortDesc = $_POST["newEventShortDesc"];
    $eventDesc = $_POST["newEventDesc"];
    $eventDate = $_POST["newEventDatetime"];
    $eventMaxPlayers = $_POST["newEventMaxPlayers"];
    $eventColor = $_POST["newEventColor"];



    //addguildevent Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/AddGuildEvent.class.php';
    include '../classes/AddGuildEvent-contr.class.php';
    
    $newGuildEvent = new AddGuildEventContr($idUser, $eventName, $eventType, $eventShortDesc, $eventDesc,  $eventDate, $eventMaxPlayers, $eventColor);

    //ErrorHandlers and eventadd
    $data = $newGuildEvent->newEvent();
    $data = json_encode($data);

    //If New event was successfully created
    $response = $data;
    echo $response;
}

?>