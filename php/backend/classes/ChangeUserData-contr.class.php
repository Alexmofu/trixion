<?php

class ChangeUserDataContr extends ChangeUserData{
    private $userId;
    private $email;
    private $password;
    private $oldPassword;

    public function __construct($userId, $email, $password, $oldPassword){
        $this->userId = $userId;
        $this->email = $email;
        $this->oldPassword = $oldPassword;
        $this->password = $password;
    }

    private function emptyInput(){
        if(empty($this->email) || empty($this->password) || empty($this->oldPassword)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function emailTooLong(){
        if (strlen($this->email) > 128){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function passwordTooShort(){
        if (strlen($this->password) < 8){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneLowercase(){
        if (!preg_match('@[a-z]@', $this->password)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneUppercase(){
        if (!preg_match('@[A-Z]@', $this->password)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneNumber(){
        if (!preg_match('@[0-9]@', $this->password)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordOneSpecialchar(){
        if (!preg_match('@[^\w]@', $this->password)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function checkOldPasswords(){
        if(!$this->checkOldPassword($this->userId, $this->oldPassword)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }



    public function changeUserData(){
        
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->emailTooLong() == false){
            $response = "Email is too Long";
            echo $response;
            exit();
        }
        if($this->invalidEmail() == false){
            $response = "Invalid Email";
            echo $response;
            exit();
        }
        if($this->passwordTooShort() == false){
            $response = "New Password is too short (min 8 characters)";
            echo $response;
            exit();
        }
        if($this->passwordOneLowercase() == false){
            $response = "New Password should contain at least 1 lowercase character";
            echo $response;
            exit();
        }
        if($this->passwordOneUppercase() == false){
            $response = "New Password should contain at least 1 uppercase character";
            echo $response;
            exit();
        }
        if($this->passwordOneNumber() == false){
            $response = "New Password should contain at least 1 number";
            echo $response;
            exit();
        }
        if($this->passwordOneSpecialchar() == false){
            $response = "New Password should contain at least 1 special character";
            echo $response;
            exit();
        }
        if($this->checkOldPasswords() == false){
            $response = "Previous Password does not match";
            echo $response;
            exit();
        }

        $this->editUserData($this->userId, $this->email, $this->password);
    }
}

?>