<?php
session_start();

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