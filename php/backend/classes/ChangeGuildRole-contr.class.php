<?php

class ChangeGuildRoleContr extends ChangeGuildRole{
    private $requesterId;
    private $memberName;
    private $userRole;


    public function __construct($requesterId, $memberName, $userRole){
        $this->requesterId = $requesterId;
        $this->memberName = $memberName;
        $this->userRole = $userRole;
    }

    private function emptyInput(){
        if(empty($this->requesterId) || empty($this->memberName) || empty($this->userRole)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidMemberName(){ 
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->memberName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function memberNameTooLong(){
        if (strlen($this->memberName) > 16){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function preventAdminPromotion(){
        if ($this->userRole == "admin"){
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
        if(!$this->checkGuildMembership($this->requesterId, $this->memberName)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    private function checkUserRole(){
        if(!$this->memberNameRole($this->memberName)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function changeRole(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->invalidMemberName() == false){
            $response = "Invalid Username";
            echo $response;
            exit();
        }
        if($this->memberNameTooLong() == false){
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
            $response = "You cant change this user's role";
            echo $response;
            exit();
        }
        if($this->preventAdminPromotion() == false){
            $response = "You cannot promote this user to Admin";
            echo $response;
            exit();
        }

        $userRoleChanged = $this->changeUserRole($this->memberName, $this->userRole);
        
        if($userRoleChanged){
            return $userRoleChanged;
        }
    }


}

?>