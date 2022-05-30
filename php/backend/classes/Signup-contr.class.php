<?php

class SignupContr extends Signup{
    private $username;
    private $password;
    private $password_repeat;
    private $email;

    public function __construct($username, $password, $password_repeat, $email){
        $this->username = $username;
        $this->password = $password;
        $this->password_repeat = $password_repeat;
        $this->email = $email;
    }

    private function emptyInput(){
        $result;
        if(empty($this->username) || empty($this->password) || empty($this->password_repeat) || empty($this->email)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidUsername(){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function passwordMatch(){
        $result;
        if($this->password !== $this->password_repeat){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function usernameTakenCheck(){
        $result;
        if(!$this->checkUser($this->username, $this->email)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function passwordTooShort(){
        $result;
        if (strlen($this->password) < 8 || strlen($this->password_repeat) < 8){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneLowercase(){
        $result;
        if (!preg_match('@[a-z]@', $this->password) || !preg_match('@[a-z]@', $this->password_repeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneUppercase(){
        $result;
        if (!preg_match('@[A-Z]@', $this->password) || !preg_match('@[A-Z]@', $this->password_repeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneNumber(){
        $result;
        if (!preg_match('@[0-9]@', $this->password) || !preg_match('@[0-9]@', $this->password_repeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneSpecialchar(){
        $result;
        if (!preg_match('@[^\w]@', $this->password) || !preg_match('@[^\w]@', $this->password_repeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }



    public function signupUser(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->invalidUsername() == false){
            $response = "Invalid Username";
            echo $response;
            exit();
        }
        if($this->invalidEmail() == false){
            $response = "Invalid Email";
            echo $response;
            exit();
        }
        if($this->passwordMatch() == false){
            $response = "Passwords do not match";
            echo $response;
            exit();
        }
        if($this->usernameTakenCheck() == false){
            $response = "Username already taken";
            echo $response;
            exit();
        }
        if($this->passwordTooShort() == false){
            $response = "Password is too short (min 8 characters)";
            echo $response;
            exit();
        }
        if($this->passwordOneLowercase() == false){
            $response = "Password should contain at least 1 lowercase character";
            echo $response;
            exit();
        }
        if($this->passwordOneUppercase() == false){
            $response = "Password should contain at least 1 uppercase character";
            echo $response;
            exit();
        }
        if($this->passwordOneNumber() == false){
            $response = "Password should contain at least 1 number";
            echo $response;
            exit();
        }
        if($this->passwordOneSpecialchar() == false){
            $response = "Password should contain at least 1 special character";
            echo $response;
            exit();
        }
        
        $this->setUser($this->username, $this->password, $this->email);
    }


}

?>