<?php

if(isset($_POST)){
    // Grab data
    $username = $_POST["username"];
    $password = $_POST["password"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/Login.class.php';
    include '../classes/Login-contr.class.php';
    
    $login = new LoginContr($username, $password);

    //ErrorHandlers and user login
    $login->loginUser();
    //ErrorHandlers and token storage
    $login->setAuthToken();

    //If Login success
    $response = "success";
    echo $response;
}

?>