<?php
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class DeleteGuildEventContr extends DeleteGuildEvent{
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

    private function guildPermissions(){
        if(!$this->checkCharacterGuild($this->eventId ,$this->idUser)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    public function deleteGuildEvent(){

        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }

        if($this->guildPermissions() == false){
            $response = "You dont have the permissions to do that";
            echo $response;
            exit();
        }


        $this->deleteEvent($this->eventId);
    }


}
?>