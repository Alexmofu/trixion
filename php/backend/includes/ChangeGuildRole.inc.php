<?php
session_start();

if(isset($_POST)){
// Grab data
$requesterId = $_SESSION["id_user"];
$memberName = $_POST["memberName"];
$userRole = $_POST["userRole"];

//LeaveGuild Class Instance
include "../classes/Dbh.class.php";
include "../classes/ChangeGuildRole.class.php";
include "../classes/ChangeGuildRole-contr.class.php";

$guildChangeRole = new ChangeGuildRoleContr($requesterId, $memberName, $userRole);

$guildChangeRole->changeRole($requesterId, $memberName, $userRole);

//Successfully changed userRole
$response = "success";
echo $response;

}

?>