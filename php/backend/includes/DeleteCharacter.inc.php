<?php
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $charId = $_POST["characterId"];

    //EditCharacterController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/DeleteCharacter.class.php';
    include '../classes/DeleteCharacter-contr.class.php';
    
    $editChar = new DeleteCharacterContr($idUser, $charId);

    //ErrorHandlers and actual deletion
    $editChar->delChar();

    //If Deletion success
    $response = "success";
    echo $response;
}

?>