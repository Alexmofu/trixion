<?php  
class ReAuth extends Dbh{

    public function reAuthUser(){

        if (empty($_SESSION['id_user']) && !empty($_COOKIE['remember'])) {
            list($selector, $authenticator) = explode(':', $_COOKIE['remember']);

            $sql = "SELECT * FROM auth_tokens WHERE selector = ?;";
            $stmt = $this->connect()->prepare($sql);
            if(!$stmt->execute(array($selector))){
                $stmt = null;
                $response = "Login Error, try again";
                echo $response;
                exit();
            }

            $row = $stmt->fetchAll();

            try{
                if (hash_equals($row[0]['token'], hash('sha256', base64_decode($authenticator)))) {
                    $_SESSION['id_user'] = $row[0]['userid'];
                }
            }catch(Error){
                    session_start();
                    session_unset();
                    session_destroy();
                    unset($_COOKIE['remember']);
                    setcookie('remember', FALSE, -1, '/', 'www.trixion.net');
                    header('Location: https://www.trixion.net/');
            }
            $stmt = null;
        }
    }   
}

?>