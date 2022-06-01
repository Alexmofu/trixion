<?php

class JoinGuild extends Dbh{

    protected function getGuildId($idUser, $guildSecret){
        $sql = "SELECT id_guild FROM guilds WHERE password = :guildSecret";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildSecret', $guildSecret);

        if(!$stmt->execute()){
            $stmt= null;
            $response = "Error While joining guilds";
            echo $response;
            exit();
        }

        $idGuild = $stmt->fetchAll();
        $idGuild = intval($idGuild[0]['id_guild']);
        $stmt = null;

        //Attempts to join the guild
        $sql = "UPDATE users SET id_guild = :idGuild WHERE id_user = :idUser";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idGuild', $idGuild);
        $stmt->bindParam(':idUser', $idUser);

        if(!$stmt->execute()){
            $stmt= null;
            $response = "Error While updating user information";
            echo $response;
            exit();
        }

        $stmt = null;

        //Gets Guild name with idguild to put into session variables
        $sql = "SELECT name FROM guilds WHERE id_guild = :idGuild";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':idGuild', $idGuild);

        if(!$stmt->execute()){
            $stmt= null;
            $response = "Error fetching guild name";
            echo $response;
            exit();
        }

        $guildName = $stmt->fetchAll();
        $guildName = $guildName[0]['name'];
        $stmt = null;

    }

    public function checkGuild($guildSecret){
        $sql = "SELECT * FROM guilds WHERE password = :guildSecret;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':guildSecret', $guildSecret);

        
        if(!$stmt->execute()){
            $stmt= null;
            $response = "Error fetching guild by secret";
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