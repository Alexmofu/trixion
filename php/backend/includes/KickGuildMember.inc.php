<?php
session_start();
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if(isset($_POST)){
// Grab data
$requesterId = $_SESSION["id_user"];
$kickUsername = $_POST["memberName"];

//LeaveGuild Class Instance
include "../classes/Dbh.class.php";
include "../classes/KickGuildMember.class.php";
include "../classes/KickGuildMember-contr.class.php";

$guildKick = new KickGuildMemberContr($requesterId, $kickUsername);

$guildKick->kickUser($requesterId, $kickUsername);

//Successfully left guild
$response = "success";
echo $response;

}

?>