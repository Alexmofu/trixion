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
include "../classes/DisbandGuild.class.php";
include "../classes/DisbandGuild-contr.class.php";

$guild = new DisbandGuildContr($idUser);

$guild->disbandAndLeaveGuild();

//Successfully left and deleted
$response = "success";
echo $response;

}

?>