<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $guildSecret = $_POST["accountGuildCode"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/JoinGuild.class.php'; //  
    include '../classes/JoinGuild-contr.class.php'; //  
    
    $joinGuild = new JoinGuildContr($idUser,$guildSecret);

    //ErrorHandlers and user login
    $joinGuild->joinGuild();

    //If Login success
    $response = "success";
    echo $response;
}

?>