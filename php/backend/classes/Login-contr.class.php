<?php

class LoginContr extends Login{
    private $username;
    private $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    private function emptyInput(){
        $result;
        if(empty($this->username) || empty($this->password)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    public function loginUser(){
        if($this->emptyInput() == false){
            $response = "Some fields are empty";
            echo $response;
            exit();
        }

        $this->getUser($this->username, $this->password);
    }

    public function setAuthToken(){
    $selector = base64_encode(random_bytes(9));
    $authenticator = random_bytes(33);

    setcookie(
        'remember',
         $selector.':'.base64_encode($authenticator),
         time() + 864000,
         '/',
         'www.trixion.net',
         true, // TLS-only
         true  // http-only
    );

    $token = hash('sha256', $authenticator);
    $expires = date('Y-m-d\TH:i:s', time() + 864000);
    $userid = $_SESSION["id_user"];

    $this->newAuthToken($selector, $token, $userid, $expires);


    }



}

?>