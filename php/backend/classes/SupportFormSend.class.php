<?php

class SupportFormSend extends Dbh{

    protected function generateSupportTicket($username, $email, $subject, $message){
        
        //Generates a new Guild and puts the id of the user as owner
        $sql = "INSERT INTO support_tickets (username, email, type, message) VALUES (:username, :email, :subject, :message);";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':subject',$subject);
        $stmt->bindParam(':message',$message);


        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error generating new Support Ticket";
            echo $response;
            exit();
        }
        $stmt = null;
    }


}

?>