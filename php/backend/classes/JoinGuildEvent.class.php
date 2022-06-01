<?php

class JoinGuildEvent extends Dbh
{

    protected function addCharacterToEvent($eventId, $characterId)
    {
        $sql = "INSERT INTO events_has_characters (id_event, id_character) VALUES (:idEvent, :idCharacter);";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':idEvent', $eventId);
        $prepared->bindParam(':idCharacter', $characterId);
        /* Executes the prepared statment if it's ok */
        if (!$prepared->execute()) {
            $prepared = null;
            $connection = null;
            $response = "New Character Creation Error";
            echo $response;
            exit();
        }

        $prepared = null;
        $connection = null;
    }

    protected function checkCharacterOwner($idUser, $characterId)
    {
        $sql = "SELECT * FROM characters WHERE id_user = :idUser AND id_character = :idCharacter";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':idUser', $idUser);
        $prepared->bindParam(':idCharacter', $characterId);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error validating membership";
            echo $response;
            exit();
        }

        if ($prepared->rowCount() == 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function checkCharacterGuild($eventId, $idUser)
    {
        $sql = "SELECT events.id_event, users.id_user FROM users, events WHERE
        users.id_guild = events.id_guild AND events.id_guild = users.id_guild AND events.id_event = :eventId AND users.id_user = :idUser";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':eventId', $eventId);
        $prepared->bindParam(':idUser', $idUser);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error Joining an event outside of your guild";
            echo $response;
            exit();
        }

        if ($prepared->rowCount() == 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function checkAlreadyJoined($eventId, $characterId)
    {
        $sql = "SELECT * FROM events_has_characters WHERE id_event = :eventId AND id_character = :idCharacter";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':eventId', $eventId);
        $prepared->bindParam(':idCharacter', $characterId);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error Already joined this event";
            echo $response;
            exit();
        }

        if ($prepared->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function checkeventCapacity($eventId)
    {
        $sql = "SELECT `max-users` FROM events WHERE id_event = :eventId";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':eventId', $eventId);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error checking event max capacity";
            echo $response;
            exit();
        }
        $connection = NULL;
        $maxUsers = $prepared->FetchAll();
        $maxCapacity = intval($maxUsers[0]['max-users']);
        $prepared = NULL;

        $sql = "SELECT * FROM events_has_characters WHERE id_event = :eventId";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':eventId', $eventId);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error getting event information";
            echo $response;
            exit();
        }

        $actualEventCharacters = $prepared->rowCount();

        if (($actualEventCharacters) >= ($maxCapacity)) {
            $result = false;
        } else{
            $result = true;
        }

        return $result;
    }


}
