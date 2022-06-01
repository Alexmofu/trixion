<?php


class DeleteCharacter extends Dbh{

    protected function deleteCharacter($idUser, $idCharacter){
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