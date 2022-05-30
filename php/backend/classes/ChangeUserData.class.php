<?php

class ChangeUserData extends Dbh{

    protected function editUserData($userId, $email, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //Generates a new Guild and puts the id of the user as owner
        $sql = "UPDATE users SET email = :email, password = :password WHERE id_user = :userId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':userId',$userId);
        $stmt->bindParam(':password',$hashedPassword);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Error while editting user data";
            echo $response;
            exit();
        }
        $stmt = null;
    }

    protected function checkOldPassword($userId, $oldPassword){
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE (id_user = :userId);');
        $stmt->bindParam(':userId',$userId);

        if(!$stmt->execute()){
            $stmt = null;
            $response = "Login Error, try again";
            echo $response;
            exit();
        }

        $hashedPassword = $stmt->fetchAll();
        $checkPassword = password_verify($oldPassword, $hashedPassword[0]["password"]);

        if($checkPassword == false){
            $stmt = null;
            $response = false;
            return $response;
        }else{
            $response = true;
            return $response;
        }
    }


}

?>