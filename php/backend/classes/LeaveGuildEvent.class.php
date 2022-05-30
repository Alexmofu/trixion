<?php

Class LeaveGuildEvent extends Dbh{

    public function leaveEvent($idUser, $eventId){
        $sql = "DELETE events_has_characters
        FROM events_has_characters
        INNER JOIN characters 
        ON events_has_characters.id_character = characters.id_character
        WHERE characters.id_user = :idUser AND events_has_characters.id_event = :eventId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':eventId',$eventId);
        $stmt->bindParam(':idUser',$idUser);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error While Leaving Event";
            echo $response;
            exit();
        }
        $stmt = null;
    }

    protected function checkCharacterGuild($eventId, $idUser)
    {
        //TODO CHECK IF USER IS TRYING TO JOIN A EVENT IN ITS GUILD
        $sql = "SELECT events.id_event, users.id_user FROM users, events WHERE
        users.id_guild = events.id_guild AND events.id_guild = users.id_guild AND events.id_event = :eventId AND users.id_user = :idUser";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':eventId', $eventId);
        $prepared->bindParam(':idUser', $idUser);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error Leaving an event outside of your guild";
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


?>