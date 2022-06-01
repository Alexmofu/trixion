<?php
session_start();

if(isset($_POST)){
// Grab data
$idUser = $_SESSION["id_user"];

//LeaveGuild Class Instance
include "../classes/Dbh.class.php";
include "../classes/LeaveGuild.class.php";

$guildLeave = new LeaveGuild($idUser);

$guildLeave->leaveGuild($idUser);

//Successfully left guild
$response = "success";
echo $response;

}

?>