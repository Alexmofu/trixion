<?php
class Main extends Dbh{

    /* Outputs user data in Json format when providing userid */
    public function getUserData($userid){
        $sql = "SELECT * FROM users WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userid]);
        $accdata = $stmt->fetchAll();
        $result = json_encode($accdata);
        return $result;
    }

    /* Outputs All game classes */
    public function getAllClasses(){
        $sql = "SELECT id_class, subclass FROM classes WHERE NOT classes.class = 'unreleased'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $classes = $stmt->fetchAll();

        return $classes;
    }

    /* Outputs Characters data when providing userid */
    public function getUserCharacters($userid){
        $sql = "SELECT * FROM characters WHERE id_user = :userid";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $characters = $stmt->fetchAll();

        return $characters;
    }

    /* Gets Character Class from classid */
    public function getCharacterClass($idClass){
        $sql = "SELECT * FROM classes WHERE id_class = :idClass";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idClass', $idClass);
        $stmt->execute();
        $classes = $stmt->fetchAll();

        return $classes;
    }


    /* Outputs Guild Data in Json format when providing guildId */
    public function getGuildData($guildId){
        $guildId = intval($guildId);
        $sql = "SELECT * FROM guilds WHERE id_guild = :guildId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = json_encode($data);
        
        return $result;
    }

    /* Outputs Guild Members data when providing guildId */
    public function getGuildMembers($guildId){
        $guildId = intval($guildId);
        $sql = "SELECT id_user, username, id_guild, guild_role FROM users WHERE id_guild = :guildId ORDER BY guild_role desc";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = json_encode($data);
        
        return $result;
    }

    public function getEventList($guildId){
        $guildId = intval($guildId);
        $sql = "SELECT * FROM events WHERE id_guild = :guildId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = json_encode($data);

        return $result;
    }

    public function getEventData($guildId, $eventId){
        $guildId = intval($guildId);
        $eventId = intval($eventId);

        $sql = "SELECT * FROM events WHERE id_guild = :guildId AND id_event = :eventId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildId', $guildId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = json_encode($data);

        return $result;
    }

    public function getEventParticipants($guildId, $eventId){
        $guildId = intval($guildId);
        $eventId = intval($eventId);
        
        $sql = "SELECT characters.name, events_has_characters.role, characters.ilvl, classes.subclass, events.id_guild, characters.id_character
        FROM events_has_characters Inner Join
        characters On events_has_characters.id_character = characters.id_character Inner Join
        classes On characters.id_class = classes.id_class Inner Join
        events On events_has_characters.id_event = events.id_event
        WHERE
        events_has_characters.id_event = :eventId AND events.id_guild = :guildId";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':guildId', $guildId);
        
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = json_encode($data);

        return $result;
    }

    public function checkCharacterInEvent($userId, $eventId){
        $userId = intval($userId);
        $eventId = intval($eventId);

        $sql = "SELECT
        characters.id_user,
        events_has_characters.id_character,
        events_has_characters.id_event
        FROM
        events_has_characters Inner Join
        characters On events_has_characters.id_character = characters.id_character
        WHERE
        characters.id_user = :userId And
        events_has_characters.id_event = :eventId";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();
        $data = $stmt->fetchAll();
        
        if($stmt->rowCount() == 0){
            return NULL;
        }else{
            $result = json_encode($data);
            return $result;
        }

    }

}

?>