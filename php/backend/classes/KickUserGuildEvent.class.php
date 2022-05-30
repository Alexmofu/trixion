<?php

Class KickUserGuildEvent extends Dbh{

    public function kickFromGuildEvent($characterId, $eventId){
        $sql = "DELETE FROM events_has_characters WHERE id_event = :eventId AND id_character = :characterId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':characterId',$characterId);
        $stmt->bindParam(':eventId',$eventId);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error While Leaving Event";
            echo $response;
            exit();
        }
        $stmt = null;
    }

    protected function checkGuildPermissions($idUser)
    {
        $sql = "SELECT guild_role FROM users WHERE guild_role = 'admin' OR guild_role = 'officer' AND id_user = :idUser;";
        $connection = $this->connect();
        $prepared = $connection->prepare($sql);
        $prepared->bindParam(':idUser', $idUser);

        if (!$prepared->execute()) {
            $prepared = null;
            $response = "Error Checking Guild Permissions";
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