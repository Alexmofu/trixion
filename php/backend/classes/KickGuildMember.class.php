<?php

class KickGuildMember extends Dbh{

    protected function kickUserFromGuild($kickUsername){
        $sql = "UPDATE users SET id_guild = NULL, guild_role = 'member' WHERE users.username = ?;";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);

        /* Executes the prepared statment if it's ok */
        if(!$prepared->execute(array($kickUsername))){
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

    protected function checkGuildMembership($requesterId, $kickUsername){
        $guildId = $this->getRequesterIdGuild($requesterId);
        $sql = "SELECT * FROM users WHERE id_guild = :guildId AND username = :kickUsername;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->bindParam(':kickUsername', $kickUsername);

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
    
    protected function kickUsernameRole($kickUsername){
        $sql = "SELECT guild_role FROM users WHERE username = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($kickUsername))){
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