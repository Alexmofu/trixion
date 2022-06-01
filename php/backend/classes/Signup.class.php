<?php
class Signup extends Dbh{

    protected function setUser($username, $password, $email){
        $sql = "INSERT INTO users (username, password, email, account_type) VALUES (?, ?, ?, 'user');";
        $stmt = $this->connect()->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($username, $hashedPassword, $email))){
            $stmt = null;
            $response = "Signup Error, try again";
            echo $response;
            exit();
        }

        $stmt = null;
    }
    
    protected function checkUser($username, $email){
        $sql = "SELECT username FROM users WHERE username = ? OR email = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($username, $email))){
            $stmt = null;
            $response = "Signup Error, please try again";
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