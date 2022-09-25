<?php
/**
 * Class that connects to the database using PDO
 * 
 * The constants are defined in access secret file
 */

class DB {
    private $host, $database, $user, $password, $connection;

    public function __construct(){

        $this->host = DB_HOST;
        $this->database = DB_DATABASE;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;

        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4",
                $this->user,
                $this->password
            );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $error) {
            echo 'Error: ' . $error->getMessage();
        }
    }
   
}