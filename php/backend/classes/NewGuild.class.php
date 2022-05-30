<?php

class NewGuild extends Dbh{

    protected function addGuild($idUser, $guildName){
        
        //Generates a new Guild and puts the id of the user as owner
        $sql = "INSERT INTO guilds (id_owner,name) VALUES (?, ?);";
        $stmt = $this->connect()->prepare($sql);



        if(!$stmt->execute(array($idUser, $guildName))){
            $stmt = null;
            $response = "New Guild Creation Error";
            echo $response;
            exit();
        }
        $stmt = null;

        
        //Fetch idguild from the new created guild (using this to avoid using lastInsertId and possible incorrect values)
        $sql = "SELECT id_guild FROM guilds WHERE id_owner = :idUser";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error while fetching guild data";
            echo $response;
            exit();
        }
        
        $idGuild = $stmt->fetchAll();
        $idGuild = intval($idGuild[0]['id_guild']);
        $stmt = null;
        
        //Updates user information about the new guild
        $sql = "UPDATE users SET id_guild = :idGuild, guild_role = 'admin' WHERE users.id_user = :idUser;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idGuild', $idGuild);
        $stmt->bindParam(':idUser', $idUser);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error while joining the new guild";
            echo $response;
            exit();
        }
        
        $stmt = null;
    }


}

?>