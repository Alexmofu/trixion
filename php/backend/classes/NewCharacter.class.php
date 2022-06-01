<?php

class NewCharacter extends Dbh{

    protected function addCharacter($idUser, $charName, $charClass, $charIlvl){
        $sql = "INSERT INTO characters (id_user, name, id_class, ilvl) VALUES (?, ?, ?, ?);";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);

        /* Executes the prepared statment if it's ok */
        if(!$prepared->execute(array($idUser, $charName, $charClass, $charIlvl))){
            $prepared = null;
            $connection = null;
            $response = "New Character Creation Error";
            echo $response;
            exit();
        }

        /* Returns the last insertedid from the current connection then close it */
        $res = $connection->lastInsertId();
        return $res;

        $prepared = null;
        $connection = null;

    }
    
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
    

}

?>