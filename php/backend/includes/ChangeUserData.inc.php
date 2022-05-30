<?php

if(isset($_POST)){
    session_start();
    // Grab data
    $userId = $_SESSION["id_user"];
    $email = $_POST["newEmail"];
    $oldPassword = $_POST["oldPassword"];
    $password = $_POST["newPassword"];
    
    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/ChangeUserData.class.php';
    include '../classes/ChangeUserData-contr.class.php';
    
    $userData = new ChangeUserDataContr($userId, $email, $password, $oldPassword);

    //ErrorHandlers and user login
    $userData->changeUserData();

    //If Login success
    $response = "success";
    echo $response;
}

?>