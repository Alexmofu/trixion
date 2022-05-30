<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include __DIR__ . "/config.php";

class Dbh{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pwd = DB_PWD;
    private $dbName = DB_NAME;

    protected function connect(){
        try{
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

        }catch(Error $e){
            echo "Error Connecting to the database";
            die();
        }
    }
}

?>