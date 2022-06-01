<?php
session_start();

if(isset($_POST)){
    // Grab data
    $idUser = $_SESSION["id_user"];
    $charName = $_POST["characterName"];
    $charClass = $_POST["characterClass"];
    $charIlvl = $_POST["characterIlvl"];

    //NewCharacterController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/NewCharacter.class.php';
    include '../classes/NewCharacter-contr.class.php';
    
    $newChar = new NewCharacterContr($idUser, $charName, $charClass, $charIlvl);

    //ErrorHandlers and characterAdd
    $data = $newChar->newCharacter();
    $data = json_encode($data);

    //If New character was successfully created
    $response = $data;
    echo $response;
}

?>