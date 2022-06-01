<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $idUser = $_SESSION["id_user"];
    $charId = $_POST["characterId"];
    $charName = $_POST["characterName"];
    $charClass = $_POST["characterClass"];
    $charIlvl = $_POST["characterIlvl"];

    //EditCharacterController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/EditCharacter.class.php';
    include '../classes/EditCharacter-contr.class.php';
    
    $editChar = new EditCharacterContr($idUser, $charId, $charName, $charClass, $charIlvl);

    //ErrorHandlers and actual deletion
    $editChar->editChar();

    //If Deletion success
    $response = "success";
    echo $response;
}

?>