<?php

class Database {

    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName   = "portal";
    
    private $connect;    

	public function __construct(){
		$this->connect = null;
    }
    
    // get the database connection
    public function getConnection(){

        try {
            $this->connect = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->connect->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connect;
    }
    
}