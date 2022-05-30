<?php

class DisbandGuildContr extends DisbandGuild{
    private $idUser;

    public function __construct($idUser){
        $this->idUser = $idUser;
    }

    public function disbandAndLeaveGuild(){
        $this->disbandGuild($this->idUser);
        $this->leaveGuild($this->idUser);
    }

}

?>