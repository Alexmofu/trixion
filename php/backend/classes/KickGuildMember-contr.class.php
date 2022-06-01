<?php

class KickGuildMemberContr extends KickGuildMember{
    private $requesterId;
    private $kickUsername;


    public function __construct($requesterId, $kickUsername){
        $this->requesterId = $requesterId;
        $this->kickUsername = $kickUsername;
    }

    private function emptyInput(){
        if(empty($this->requesterId) || empty($this->kickUsername)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidKickUsername(){ 
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->kickUsername)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function kickUsernameTooLong(){
        if (strlen($this->kickUsername) > 16){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function guildOwnership(){
        if(!$this->checkOwnership($this->requesterId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function guildMembership(){
        if(!$this->checkGuildMembership($this->requesterId, $this->kickUsername)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    private function checkUserRole(){
        if(!$this->kickUsernameRole($this->kickUsername)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    



    public function kickUser(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->invalidKickUsername() == false){
            $response = "Invalid Username";
            echo $response;
            exit();
        }
        if($this->kickUsernameTooLong() == false){
            $response = "Username to kick is too long";
            echo $response;
            exit();
        }
        if($this->guildOwnership() == false){
            $response = "You dont have permissions to do that";
            echo $response;
            exit();
        }
        if($this->guildMembership() == false){
            $response = "That user doesn't belong on your guild";
            echo $response;
            exit();
        }
        if($this->checkUserRole() == false){
            $response = "You cant kick this user";
            echo $response;
            exit();
        }

        $kickedUser = $this->kickUserFromGuild($this->kickUsername);
        
        if($kickedUser){
            return $kickedUser;
        }
    }


}

?>