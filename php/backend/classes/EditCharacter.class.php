<?php

class EditCharacter extends Dbh{

    protected function editCharacter($idUser, $idCharacter, $charName, $charClass, $charIlvl){
        $sql = "UPDATE characters SET name = :charName, ilvl = :charIlvl, id_class = :charClass WHERE id_user = :idUser AND id_character = :idCharacter;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idCharacter', $idCharacter);
        $stmt->bindParam(':charName', $charName);
        $stmt->bindParam(':charClass', $charClass);
        $stmt->bindParam(':charIlvl', $charIlvl);
        
        if(!$stmt->execute()){
            $stmt = null;
            $response = "Edit Character Creation Error";
            echo $response;
            exit();
        }

        $stmt = null;
    }
    

    //Checks name duplicates
    protected function checkCharacter($idUser, $charName){
        $sql = "SELECT name FROM characters WHERE id_user = ? AND name= ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($idUser, $charName))){
            $stmt = null;
            $response = "New Character Creation Error";
            echo $response;
            exit();
        }

        if($stmt->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }

    //Checking user ownership of characterid
    protected function checkCharacterOwnership($idUser, $charId){
        $sql = "SELECT * FROM characters WHERE id_user = :idUser AND id_character = :charId;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':charId', $charId);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error Checking Character Ownership";
            echo $response;
            exit();
        }
        
        if($stmt->rowCount() == 1){
            $resultCheck = true;
        }
        else{
            $resultCheck = false;
        }

        return $resultCheck;

    }
    

}

?>