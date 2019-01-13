<?php

class Authenticate {

    private $tableName = "users";
    private $studentTable = "students";
    private $companyTable = "company";
    private $connect;
    private $stmt;

    public $email;
    public $pass;

    public $userId;
    public $username;
    public $userType;
    public $agentName;
    public $portalId;

    public $name, $number, $website, $address;


    function __construct($db){
        $this->connect = $db;
    }


    function login(){
        $query = "SELECT id, email, password, user_type FROM {$this->tableName} WHERE email = :email AND password = :pass";
        
        $this->stmt = $this->connect->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->pass  = htmlspecialchars(strip_tags($this->pass));

        $this->stmt->bindParam(":email", $this->email);
        $this->stmt->bindParam(":pass", $this->pass);

        // execute the query
        $this->stmt->execute();
        $num = $this->stmt->rowCount();

        if($num > 0){
            $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
                $this->userId       = $row['id'];
                $this->username     = $row['username'];
                $this->userType     = $row['user_type'];
            return true;
        }
        return false;
    }


    public function register(){
        $query = "SELECT id, email, password, user_type FROM {$this->tableName} WHERE email = :email AND password = :pass";
        
        $this->stmt = $this->connect->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->pass  = htmlspecialchars(strip_tags($this->pass));

        $this->stmt->bindParam(":email", $this->email);
        $this->stmt->bindParam(":pass", $this->pass);

        // execute the query
        $this->stmt->execute();
        $num = $this->stmt->rowCount();

        if($num > 0){
            $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
                $this->userId       = $row['id'];
                $this->username     = $row['username'];
                $this->userType     = $row['user_type'];
            return true;
        }
        return false;
    }
    
}