<?php
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class DeleteCharacter extends Dbh{

    protected function deleteCharacter($idUser, $idCharacter){
       /*  $sql = "UPDATE characters SET (name, id_class, ilvl) VALUES (:charName, :charClass, :charIlvl) WHERE id_user = :idUser AND id_character = :idCharacter;"; */
        $sql = "DELETE FROM characters WHERE id_user = :idUser AND id_character = :idCharacter;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idCharacter', $idCharacter);
        
        if(!$stmt->execute()){
            $stmt = null;
            $response = "Delete Character Error";
            echo $response;
            exit();
        }

        $stmt = null;
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
        
        $resultCheck;
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