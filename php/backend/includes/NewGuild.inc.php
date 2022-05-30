<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $guildName = $_POST["guildName"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/NewGuild.class.php';
    include '../classes/NewGuild-contr.class.php';
    
    $guild = new NewGuildContr($idUser,$guildName);

    //ErrorHandlers and user login
    $guild->newGuild();

    //If Login success
    $response = "success";
    echo $response;
}

?>