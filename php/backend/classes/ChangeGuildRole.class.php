<?php

class ChangeGuildRole extends Dbh{

    protected function changeUserRole($memberName, $userRole){
        $sql = "UPDATE users SET guild_role = ? WHERE users.username = ?;";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);

        /* Executes the prepared statment if it's ok */
        if(!$prepared->execute(array($userRole, $memberName))){
            $prepared = null;
            $connection = null;
            $response = "New Character Creation Error";
            echo $response;
            exit();
        }


    }
    
    protected function checkOwnership($requesterId){
        $sql = "SELECT guild_role FROM users WHERE id_user = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($requesterId))){
            $stmt = null;
            $response = "Error validating ownership";
            echo $response;
            exit();
        }

        if($stmt->rowCount() < 0){
            $resultCheck = false;
        }
        else{
            /* Checking if guild_role is officer or admin */
            $guildRole = $stmt->fetchAll();
            if($guildRole[0]['guild_role'] == "admin" || $guildRole[0]['guild_role'] == "officer"){
                $resultCheck = true;
            }else{
                $resultCheck = false;
            }
        }

        return $resultCheck;

    }

    protected function checkGuildMembership($requesterId, $memberName){
        $guildId = $this->getRequesterIdGuild($requesterId);
        $sql = "SELECT * FROM users WHERE id_guild = :guildId AND username = :memberName;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->bindParam(':memberName', $memberName);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error validating membership";
            echo $response;
            exit();
        }

        if($stmt->rowCount() == 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }

    protected function getRequesterIdGuild($requesterId){
        $sql = "SELECT id_guild FROM users WHERE id_user = ?;";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);

        /* Executes the prepared statment if it's ok */
        if(!$prepared->execute(array($requesterId))){
            $prepared = null;
            $connection = null;
            $response = "Error Fetching idguild";
            echo $response;
            exit();
        }

        $result = $prepared->FetchAll();
        return $result[0]['id_guild'];
    }
    
    protected function memberNameRole($memberName){
        $sql = "SELECT guild_role FROM users WHERE username = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($memberName))){
            $stmt = null;
            $response = "Cant kick this person";
            echo $response;
            exit();
        }

        if($stmt->rowCount() == 0){
            $resultCheck = false;
        }
        else{
            /* Checking if guild_role is officer or admin */
            $guildRole = $stmt->fetchAll();
            if($guildRole[0]['guild_role'] == "member" || $guildRole[0]['guild_role'] == "officer"){
                $resultCheck = true;
            }else{
                $resultCheck = false;
            }
        }

        return $resultCheck;

    }
    

}

?>