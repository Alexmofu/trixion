<?php

class SupportFormSendContr extends SupportFormSend{
    private $username;
    private $email;
    private $subject;
    private $message;

    public function __construct($username, $email, $subject, $message){
        $this->username = $username;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    private function emptyInput(){
        if(empty($this->username) || empty($this->email) || empty($this->subject) || empty($this->message)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function usernameTooLong(){
        if (strlen($this->username) > 24){
            $result = false;
        }
        else{
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

    private function messageTooLong(){
        if (strlen($this->email) > 5120){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidMessage(){ 
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $this->message)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUsername(){ 
        if (!preg_match("/^[a-zA-Z]*$/", $this->username)){
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



    public function newSupportTicket(){
        
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }

        if($this->usernameTooLong() == false){
            $response = "Username is too Long";
            echo $response;
            exit();
        }

        if($this->emailTooLong() == false){
            $response = "Email is too Long";
            echo $response;
            exit();
        }
        if($this->messageTooLong() == false){
            $response = "Message is too long";
            echo $response;
            exit();
        }
        if($this->invalidUsername() == false){
            $response = "Username contains invalid characters";
            echo $response;
            exit();
        }
        if($this->invalidEmail() == false){
            $response = "Invalid Email";
            echo $response;
            exit();
        }
        if($this->invalidMessage() == false){
            $response = "Message contains invalid characters";
            echo $response;
            exit();
        }

        $this->generateSupportTicket($this->username, $this->email, $this->subject, $this->message);
    }




}

?>