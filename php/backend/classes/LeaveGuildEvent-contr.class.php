<?php

class LeaveGuildEventContr extends LeaveGuildEvent{
    private $idUser;
    private $eventId;

    public function __construct($idUser, $eventId){
        $this->idUser = $idUser;
        $this->eventId = $eventId;
    }


    private function emptyInput(){
        if(empty($this->idUser) || empty($this->eventId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    /* Check if iduser is in event */
    private function characterGuild(){
        if(!$this->checkCharacterGuild($this->eventId, $this->idUser)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function leaveGuildEvent(){
        if($this->emptyInput() == false){
            $res = "Some fields are empty";
            echo $res;
            exit();
        }
        if($this->characterGuild() == false){
            $res = "Attempted to leave an event outside of your guild";
            echo $res;
            exit();
        }

        $this->leaveEvent($this->idUser, $this->eventId);
    }

}

?>