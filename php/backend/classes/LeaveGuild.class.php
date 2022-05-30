<?php

Class LeaveGuild extends Dbh{

    public function leaveGuild($idUser){
        $sql = "UPDATE users SET id_guild = NULL, guild_role = 'member' WHERE users.id_user = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($idUser))){
            $stmt = null;
            $response = "Error While Leaving Guild";
            echo $response;
            exit();
        }
        $stmt = null;
    }
}


?>