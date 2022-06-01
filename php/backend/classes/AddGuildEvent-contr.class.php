<?php
class AddGuildEventContr extends AddGuildEvent{
    private $idUser;
    private $eventName;
    private $eventType;
    private $eventShortDesc;
    private $eventDesc;
    private $eventDate;
    private $eventMaxPlayers;
    private $eventColor;

    public function __construct($idUser, $eventName, $eventType, $eventShortDesc, $eventDesc, $eventDate, $eventMaxPlayers, $eventColor){
        $this->idUser = $idUser;
        $this->eventName = $eventName;
        $this->eventType = $eventType;
        $this->eventShortDesc = $eventShortDesc;
        $this->eventDesc = $eventDesc;
        $this->eventDate = $eventDate;
        $this->eventMaxPlayers = $eventMaxPlayers;
        $this->eventColor = $eventColor;
    }

    private function emptyInput(){
        if(empty($this->idUser) || empty($this->eventName) || empty($this->eventType) || empty($this->eventShortDesc) || empty($this->eventDesc) || empty($this->eventDate) || empty($this->eventMaxPlayers) || empty($this->eventColor)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidEventName(){ 
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $this->eventName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEventType(){ 
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $this->eventType)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEventShortDesc(){ 
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $this->eventShortDesc)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEventDesc(){ 
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $this->eventDesc)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function eventNameTooLong(){
        if (strlen($this->eventName) > 24){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function eventTypeTooLong(){
        if (strlen($this->eventType) > 20){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function shortDescTooLong(){
        if (strlen($this->eventShortDesc) > 128){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function descTooLong(){
        if (strlen($this->eventDesc) > 512){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function maxPlayersOnlyNumber(){
        if (!preg_match("/^[1-9][0-9]*$/", $this->eventMaxPlayers)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function maxPlayersLimit(){
        if (!$this->eventMaxPlayers >= 1 && !$this->eventMaxPlayers <= 100){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function eventColor(){
        if (!preg_match('/^#[a-f0-9]{6}$/i', $this->eventColor)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    

    /* Handlers and execution */
    public function newEvent(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->invalidEventName() == false){
            $response = "Invalid Event Name";
            echo $response;
            exit();
        }
        if($this->invalidEventType() == false){
            $response = "Invalid Event Type";
            echo $response;
            exit();
        }
        if($this->invalidEventShortDesc() == false){
            $response = "Invalid Event Short Description";
            echo $response;
            exit();
        }
        if($this->invalidEventDesc() == false){
            $response = "Invalid Event Description";
            echo $response;
            exit();
        }
        if($this->eventNameTooLong() == false){
            $response = "Event Name Too Long";
            echo $response;
            exit();
        }
        if($this->eventTypeTooLong() == false){
            $response = "Event Type Too Long";
            echo $response;
            exit();
        }
        if($this->shortDescTooLong() == false){
            $response = "Event Short Description Too Long";
            echo $response;
            exit();
        }
        if($this->descTooLong() == false){
            $response = "Event Description Too Long";
            echo $response;
            exit();
        }
        if($this->maxPlayersOnlyNumber() == false){
            $response = "Max Players should be a number";
            echo $response;
            exit();
        }
        if($this->maxPlayersLimit() == false){
            $response = "Max Players should be between 1 and 100";
            echo $response;
            exit();
        }
        if($this->eventColor() == false){
            $response = "Event Color Should be Hex";
            echo $response;
            exit();
        }
        
        
        
        $guildId = $this->getGuildId($this->idUser);
        $newEventId = $this->addNewEvent($guildId, $this->eventName, $this->eventType, $this->eventShortDesc, $this->eventDesc, $this->eventDate, $this->eventMaxPlayers, $this->eventColor);
        
        if($newEventId){
            return $newEventId;
        }
    }


}

?>