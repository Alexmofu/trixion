<?php
session_start();

if(isset($_POST)){
// Grab data
$idUser = $_SESSION["id_user"];

//LeaveGuild Class Instance
include "../classes/Dbh.class.php";
include "../classes/DisbandGuild.class.php";
include "../classes/DisbandGuild-contr.class.php";

$guild = new DisbandGuildContr($idUser);

$guild->disbandAndLeaveGuild();

//Successfully left and deleted
$response = "success";
echo $response;

}

?>