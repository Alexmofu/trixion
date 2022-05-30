<?php
session_start();
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


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