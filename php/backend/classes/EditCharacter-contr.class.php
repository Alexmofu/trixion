<?php
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class EditCharacterContr extends EditCharacter{
    private $idUser;
    private $charId;
    private $charName;
    private $charClass;
    private $charIlvl;

    public function __construct($idUser, $charId, $charName, $charClass, $charIlvl){
        $this->idUser = $idUser;
        $this->charId = $charId;
        $this->charName = $charName;
        $this->charClass = $charClass;
        $this->charIlvl = $charIlvl;
    }

    private function emptyInput(){
        $result;
        if(empty($this->idUser) || empty($this->charId) || empty($this->charName) || empty($this->charClass) || empty($this->charIlvl)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidCharName(){ 
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->charName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function charNameTooLong(){
        $result;
        if (strlen($this->charName) > 16){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function charIlvlOnlyNumber(){
        $result;
        if (!preg_match("/^[1-9][0-9]*$/", $this->charIlvl)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function charIlvlLength(){
        $result;
        if (strlen($this->charIlvl) > 4){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    /* private function charAlreadyExists(){
        $result;
        if(!$this->checkCharacter($this->idUser, $this->charName)){
            $result = false;
            if(!$this->checkSameCharacter($this->charname)){

            }
        }else{
            $result = true;
        }
        return $result;
    } */

    private function charOwnership(){
        $result;
        if(!$this->checkCharacterOwnership($this->idUser, $this->charId)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    public function editChar(){
        if($this->emptyInput() == false){
            $response = "Empty Input";
            echo $response;
            exit();
        }
        if($this->invalidCharName() == false){
            $response = "Invalid Character Name";
            echo $response;
            exit();
        }
        if($this->charNameTooLong() == false){
            $response = "Character name is too long";
            echo $response;
            exit();
        }
        if($this->charIlvlOnlyNumber() == false){
            $response = "Character Ilvl should be a number";
            echo $response;
            exit();
        }
        if($this->charIlvlLength() == false){
            $response = "Character Ilvl cant be longer than 4 digits";
            echo $response;
            exit();
        }
        /* if($this->charAlreadyExists() == false){
            $response = "Character Already Exists";
            echo $response;
            exit();
        } */
        if($this->charOwnership() == false){
            $response = "Not you character Id, nice try.";
            echo $response;
            exit();
        }




        $this->editCharacter($this->idUser, $this->charId, $this->charName, $this->charClass, $this->charIlvl);
    }


}
?>