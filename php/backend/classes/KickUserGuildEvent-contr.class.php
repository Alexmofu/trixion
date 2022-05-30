<?php

class KickUserGuildEventContr extends KickUserGuildEvent{
    private $idUser;
    private $eventId;
    private $characterId;

    public function __construct($idUser, $eventId, $characterId){
        $this->idUser = $idUser;
        $this->eventId = $eventId;
        $this->characterId = $characterId;
    }


    /* Empty input handler */
    private function emptyInput(){
        if(empty($this->idUser) || empty($this->eventId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    /* Check if iduser is in event */
    private function guildPermissions(){
        if(!$this->checkGuildPermissions($this->idUser)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function kickGuildEvent(){
        if($this->emptyInput() == false){
            $res = "Some fields are empty";
            echo $res;
            exit();
        }
        if($this->guildPermissions() == false){
            $res = "Attempted to kick an user without guild permissions";
            echo $res;
            exit();
        }

        $this->kickFromGuildEvent($this->characterId, $this->eventId);
    }

}

?>