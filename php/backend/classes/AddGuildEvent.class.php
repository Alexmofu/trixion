<?php
//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class AddGuildEvent extends Dbh{

    protected function addNewEvent($idGuild, $eventName, $eventType, $eventShortDesc, $eventDesc, $eventDate, $eventMaxPlayers, $eventColor){
        $sql = "INSERT INTO `events` (`id_guild`, `name`, `shortDesc`, `description`, `max-users`, `type`, `date`, `color`, `status`)
        VALUES (:idGuild, :eventName, :eventShortDesc, :eventDesc, :eventMaxPlayers, :eventType, :eventDate, :eventColor, 0)";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':idGuild', $idGuild);
        $prepared->bindParam(':eventName', $eventName);
        $prepared->bindParam(':eventShortDesc', $eventShortDesc);
        $prepared->bindParam(':eventDesc', $eventDesc);
        $prepared->bindParam(':eventMaxPlayers', $eventMaxPlayers);
        $prepared->bindParam(':eventType', $eventType);
        $prepared->bindParam(':eventDate', $eventDate);
        $prepared->bindParam(':eventColor', $eventColor);

        /* Executes the prepared statment if it's ok */
        if(!$prepared->execute()){
            $prepared = null;
            $connection = null;
            $response = "New Event Creation Error";
            echo $response;
            exit();
        }

        /* Returns the last insertedid from the current connection then close it */
        $res = $connection->lastInsertId();
        return $res;

        $prepared = null;
        $connection = null;

    }
    
    protected function getGuildId($idUser){
        $sql = "SELECT id_guild FROM users WHERE id_user = :idUser;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error Fetching guildId";
            echo $response;
            exit();
        }

        $idGuild = $stmt->fetchAll();

        if(!$stmt->rowCount() > 0){
            $result = false;
        }
        else{
            $result = $idGuild[0]['id_guild'];
        }

        return $result;

    }
}

?>