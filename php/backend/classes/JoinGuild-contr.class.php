<?php

class JoinGuildContr extends JoinGuild{
    private $idUser;
    private $guildSecret;

    public function __construct($idUser, $guildSecret){
        $this->idUser = $idUser;
        $this->guildSecret = $guildSecret;
    }

    private function emptyInput(){
        $result;
        if(empty($this->idUser) || empty($this->guildSecret)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function guildNotExists(){
        $result;
        if(!$this->checkGuild($this->guildSecret)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function joinGuild(){
        if($this->emptyInput() == false){
            $response = "Some fields are empty";
            echo $response;
            exit();
        }

        if($this->guildNotExists() == true){
            $response = "Invalid Join Code";
            echo $response;
            exit();
        }

        $this->getGuildId($this->idUser, $this->guildSecret);
    }

}

?>