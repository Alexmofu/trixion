<?php

class NewGuildContr extends NewGuild{
    private $idUser;
    private $guildName;

    public function __construct($idUser,$guildName){
        $this->idUser = $idUser;
        $this->guildName = $guildName;
    }

    private function emptyInput(){
        $result;
        if(empty($this->idUser) || empty($this->guildName)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function guildNameTooLong(){
        $result;
        if (strlen($this->guildName) > 15){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidGuildName(){ 
        $result;
        if (!preg_match("/^[a-zA-Z]*$/", $this->guildName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }



    public function newGuild(){
        
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }

        if($this->invalidGuildName() == false){
            $response = "Invalid Guild Name";
            echo $response;
            exit();
        }

        if($this->guildNameTooLong() == false){
            $response = "Guild name is too long";
            echo $response;
            exit();
        }

        $this->addGuild($this->idUser, $this->guildName);
    }




}

?>