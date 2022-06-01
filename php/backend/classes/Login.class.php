<?php

class Login extends Dbh{

    protected function getUser($username, $password){
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE (username=? OR email=?);');

        if(!$stmt->execute(array($username, $username))){
            $stmt = null;
            $response = "Login Error, try again";
            echo $response;
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            $response = "Username does not exists";
            echo $response;
            exit();
        }

        $hashedPassword = $stmt->fetchAll();
        $checkPassword = password_verify($password, $hashedPassword[0]["password"]);

        if($checkPassword == false){
            $stmt = null;
            $response = "Wrong password";
            echo $response;
            exit();
        }elseif($checkPassword == true){
            $sql = "SELECT * FROM users WHERE (username=? OR email=?) AND password=?;";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($username, $username, $hashedPassword[0]['password']))){
                $stmt = null;
                $response = "Login Error, try again";
                echo $response;
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                $response = "Login Error, try again";
                echo $response;
                exit();
            }

            $user = $stmt->fetchAll();
            session_start();
            /* Store information about the logged user into session variables */
            $_SESSION["id_user"] = $user[0]["id_user"];
            $stmt = null;

        }

        $stmt = null;
    }

    protected function newAuthToken($selector, $token, $userid, $expires){
        $sql = "INSERT INTO auth_tokens (selector, token, userid, expires) VALUES (?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($selector, $token, $userid, $expires))){
            $stmt = null;
            $response = "Login Error, try again";
            echo $response;
            exit();
        }


    }
    

}

?>