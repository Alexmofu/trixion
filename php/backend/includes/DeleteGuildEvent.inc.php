<?php
session_start();


if(isset($_POST)){
// Grab data
$idUser = $_SESSION["id_user"];
$eventId = $_POST['eventId'];

//LeaveGuild Class Instance
include "../classes/Dbh.class.php";
include "../classes/DeleteGuildEvent.class.php";
include "../classes/DeleteGuildEvent-contr.class.php";

$event = new DeleteGuildEventContr($idUser, $eventId);

$event->deleteGuildEvent();

//Successfully left and deleted
$response = "success";
echo $response;

}

?>