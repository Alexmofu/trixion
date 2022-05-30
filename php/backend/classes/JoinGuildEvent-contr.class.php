<?php

class JoinGuildEventContr extends JoinGuildEvent{
    private $idUser;
    private $eventId;
    private $characterId;

    public function __construct($idUser, $eventId, $characterId){
        $this->idUser = $idUser;
        $this->eventId = $eventId;
        $this->characterId = $characterId;
    }

    private function emptyInput(){
        if(empty($this->idUser) || empty($this->eventId) || empty($this->characterId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function alreadyJoined(){
        if(!$this->checkAlreadyJoined($this->eventId, $this->characterId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function characterGuild(){
        if(!$this->checkCharacterGuild($this->eventId, $this->idUser)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function characterOwner(){
        if(!$this->checkCharacterOwner($this->idUser, $this->characterId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    //TODO MORE CHECKS
    private function eventCapacity(){
        if(!$this->checkeventCapacity($this->eventId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    //CHECK IF EVENT IS ALREADY FULL


    public function joinGuildEvent(){
        if($this->emptyInput() == false){
            $res = "Some fields are empty";
            echo $res;
            exit();
        }

        if($this->characterOwner() == false){
            $res = "Attempting to join with a character that's not yours";
            echo $res;
            exit();
        }
        
        if($this->alreadyJoined() == false){
            $res = "Already joined that event";
            echo $res;
            exit();
        }

        if($this->characterGuild() == false){
            $res = "Attempted to join an event outside of your guild";
            echo $res;
            exit();
        }

        if($this->eventCapacity() == false){
            $res = "Attempted to join an event at max capacity";
            echo $res;
            exit();
        }


        $this->addCharacterToEvent($this->eventId, $this->characterId);
    }

}

?>