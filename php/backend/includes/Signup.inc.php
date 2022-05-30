<?php

if(isset($_POST)){
    // Grab data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password_repeat"];
    $email = $_POST["email"];

    //SignupController Class Instance
    include "../classes/Dbh.class.php";
    include '../classes/Signup.class.php';
    include '../classes/Signup-contr.class.php';

    /* Login after succesfully new account */
    
    $signup = new SignupContr($username, $password, $password_repeat, $email);

    //ErrorHandlers and user signup
    $signup->signupUser();

    
    /* Login after successfully new account */
    include '../classes/Login.class.php';
    include '../classes/Login-contr.class.php';
    $login = new LoginContr($username, $password);

    //ErrorHandlers and user login
    $login->loginUser();
    //ErrorHandlers and token storage
    $login->setAuthToken();

    //If New account was successfully created
    $response = "success";
    echo $response;
}

?>