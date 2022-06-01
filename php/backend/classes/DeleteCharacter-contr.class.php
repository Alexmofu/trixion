<?php

class DeleteCharacterContr extends DeleteCharacter{
    private $idUser;
    private $charId;

    public function __construct($idUser, $charId){
        $this->idUser = $idUser;
        $this->charId = $charId;
    }

    private function emptyInput(){
        if(empty($this->idUser) || empty($this->charId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function charOwnership(){
        if(!$this->checkCharacterOwnership($this->idUser, $this->charId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    public function delChar(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->charOwnership() == false){
            $response = "Not you character Id, nice try.";
            echo $response;
            exit();
        }

        $this->deleteCharacter($this->idUser, $this->charId);
    }


}
?>