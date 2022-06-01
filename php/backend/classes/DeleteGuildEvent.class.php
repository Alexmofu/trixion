<?php
class DeleteGuildEvent extends Dbh
{

    protected function deleteEvent($eventId)
    {
        $sql = "DELETE FROM events WHERE id_event = :idEvent";
        /* Establishing a variable for the current connection */
        $connection = $this->connect();
        /* Prepares the statement in the current connection */
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':idEvent', $eventId);
        /* Executes the prepared statment if it's ok */
        if (!$prepared->execute()) {
            $prepared = null;
            $connection = null;
            $response = "Event Deletion Error";
            echo $response;
            exit();
        }

        $prepared = null;
        $connection = null;
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
            $response = "Error Deleting an event outside of your guild";
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



}
